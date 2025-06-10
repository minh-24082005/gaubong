<?php

namespace App\Controllers\Admin;

use App\Controller;
use App\Models\User;
use Rakit\Validation\Validator;

class UserController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $dataUser = $this->user->findAll();
        return view('Admin.users.list', compact('dataUser'));
    }
    public function create()
    {
        return view('Admin.users.create');
    }
    public function store()
    {
        try {
            $data = $_POST + $_FILES;

            // Validate
            $validator = new Validator;

            $errors = $this->validate(
                $validator,
                $data,
                [
                    'name'                  => 'required|max:50',
                    'email'                 => [
                        'required',
                        'email',
                        function ($value) {
                            $flag = (new User)->checkExistsEmailForCreate($value);

                            if ($flag) {
                                return ":attribute has existed";
                            }
                        }
                    ],
                    'password'              => 'required|min:6|max:30',
                    'confirm_password'      => 'required|same:password',
                    'dien_thoai'            => 'max:20',
                    'dia_chi'               => 'max:255',
                    'thanhpho'              => 'max:100',
                    'type'                  => [$validator('in', ['admin', 'client'])],
                ]
            );

            if (!empty($errors)) {
                $_SESSION['status']     = false;
                $_SESSION['msg']        = 'Thao tác KHÔNG thành công!';
                $_SESSION['data']       = $_POST;
                $_SESSION['errors']     = $errors;

                redirect('/admin/users/create');
            } else {
                $_SESSION['data'] = null;
            }

            // Upload file 
            if (is_upload('avatar')) {
                $data['avatar'] = $this->uploadFile($data['avatar'], 'users');
            } else {
                $data['avatar'] = null;
            }

            // Điểu chỉnh dữ liệu
            unset($data['confirm_password']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['ngay_capnhat'] = date('Y-m-d H:i:s');

            // Insert
            $this->user->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'dien_thoai' => $data['dien_thoai'],
                'dia_chi' => $data['dia_chi'],
                'thanhpho' => $data['thanhpho'],
                'type' => $data['type'],
                'ngay_capnhat' => $data['ngay_capnhat'],
            ]);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';

            redirect('/admin/users');
        } catch (\Throwable $th) {
            $this->logError($th->__tostring());

            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Thao tác KHÔNG thành công!';
            $_SESSION['data'] = $_POST;

            redirect('/admin/users/create');
        }
    }
    public function edit($id)
    {
        $user = $this->user->find($id);
        if (empty($user)) {
            redirect404();
        }
        return view('Admin.users.edit', compact('user'));
    }
    public function show($id)
    {
        $user = $this->user->find($id);

        if (empty($user)) {
            redirect404();
        }

        $title = 'Chi tiết người dùng';

        return view('Admin.users.show', compact('user', 'title'));
    }
    public function update($id)
    {
        try {
            $user = $this->user->find($id);
            if (empty($user)) {
                redirect404();
            }

            $data = $_POST + $_FILES;
            $validator = new Validator;

            $errors = $this->validate(
                $validator,
                $data,
                [
                    'name' => 'required|max:50',
                    'email' => [
                        'required',
                        'email',
                        function ($value) use ($id) {
                            $flag = (new User)->checkExistsEmailForUpdate($id, $value);
                            if ($flag) {
                                return ":attribute has existed";
                            }
                        }
                    ],
                    'type' => [$validator('in', ['admin', 'client'])]
                ]
            );

            if (!empty($errors)) {
                $_SESSION['status'] = false;
                $_SESSION['msg'] = 'Có lỗi xảy ra, vui lòng thử lại';
                $_SESSION['errors'] = $errors;
                $_SESSION['data'] = $_POST;

                redirect('/admin/users/edit/' . $id);
            }


            // Update user
            $this->user->update($id, $data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Cập nhật dữ liệu thành công';
            redirect('/admin/users');
            exit;
        } catch (\Throwable $e) {
            $this->logError($e->__toString());
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Có lỗi xảy ra, vui lòng thử lại';
            $_SESSION['data'] = $_POST;

            redirect('/admin/users/edit/' . $id);
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->user->find($id);
            if (empty($user)) {
                redirect404();
            }

            // Xóa người dùng và dữ liệu liên quan
            $result = $this->user->delete($id);
            
            if ($result) {
                $_SESSION['status'] = true;
                $_SESSION['msg'] = 'Xóa người dùng thành công';
            } else {
                $_SESSION['status'] = false;
                $_SESSION['msg'] = 'Không thể xóa người dùng';
            }

            redirect('/admin/users');
        } catch (\Exception $e) {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Có lỗi xảy ra khi xóa người dùng: ' . $e->getMessage();
            redirect('/admin/users');
        }
    }
}
