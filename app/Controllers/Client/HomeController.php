<?php
namespace App\Controllers\Client;

use App\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Rakit\Validation\Validator;



class HomeController extends Controller
{
    private Product $product;
    private Banner $banner;
    private User $user;
    private Category $category; // Assuming you have a Category model
    public function __construct()
    {
        $this->banner = new Banner();
        $this->user = new User();
        $this->product = new Product();
        $this->category = new Category(); // Assuming you have a Category model
    }
    public function index()
    {
        $products = $this->product->getLatest(4);
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = 8;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        $result = $this->product->paginateClien($page, $limit, $keyword, 'ASC'); // chắc chắn gọi paginateClien
        $productss = $result['data'];
        $totalPage = $result['totalPage'];

        $banners = $this->banner->findAll();

        return view('Client.home', compact('products', 'banners', 'productss', 'page', 'limit', 'totalPage', 'keyword'));
    }


    public function danhmuc()
    {
        $category_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = 8;
        // tìm kiếm
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

        // Lấy sản phẩm theo tất cả điều kiện
        // lọc
        $result = $this->product->paginateClientFull($page, $limit, $category_id, $keyword, $sort);

        $products = $result['data'];
        $totalPage = $result['totalPage'];

        $category = $this->category->findAll();
        $banners = $this->banner->findAll();

        return view('Client.danhmuc', compact(
            'products',
            'category',
            'banners',
            'category_id',
            'keyword',
            'sort',
            'page',
            'totalPage'
        ));
    }

    public function logout()
    {
        unset($_SESSION['user']);
        redirect('/');
    }
    public function login()
    {
        try {
            $data = $_POST;
            $validator = new Validator;
            $errors = $this->validate(
                $validator,
                $data,
                [
                    'email' => 'required|email',
                    'password' => 'required|min:6|max:30'
                ]
            );

            $user = $this->user->getUserByEmail($data['email']);

            // Nếu có lỗi validate hoặc không tìm thấy user
            if (!empty($errors) || empty($user)) {
                if (empty($user)) {
                    $errors['email'][] = 'Email does not exist';
                }
                $_SESSION['errors'] = $errors;
                $_SESSION['status'] = false;
                $_SESSION['msg'] = 'Thao tác không thành công!';
                $_SESSION['data'] = $_POST;
                return redirect('/');
            }

            // Kiểm tra mật khẩu
            if (!password_verify($data['password'], $user['password'])) {
                $_SESSION['errors']['verify'] = 'Incorrect password';
                $_SESSION['status'] = false;
                $_SESSION['msg'] = 'Thao tác không thành công!';
                $_SESSION['data'] = $_POST;
                return redirect('/');
            }

            // Thành công
            $_SESSION['user'] = $user;
            $_SESSION['data'] = null;
            $_SESSION['status'] = true;

            $redirectTo = (strtolower($user['type']) == 'admin') ? '/admin' : '/';
            return redirect($redirectTo);
        } catch (\Throwable $th) {
            $this->logError($th->__toString());
            $_SESSION['msg'] = 'Đã xảy ra lỗi hệ thống!';
            $_SESSION['status'] = false;
            $_SESSION['data'] = $_POST;
            return redirect('/');
        }
    }

public function register()
{
    try {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $password_confirmation = $_POST['password_confirmation'] ?? '';
        $dien_thoai = trim($_POST['dien_thoai'] ?? '');
        $dia_chi = trim($_POST['dia_chi'] ?? '');
        $thanhpho = trim($_POST['thanhpho'] ?? '');

        if (!$name || !$email || !$password || !$password_confirmation) {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Vui lòng điền đầy đủ thông tin bắt buộc.';
            $_SESSION['data'] = $_POST;
            return redirect('/');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Email không hợp lệ.';
            $_SESSION['data'] = $_POST;
            return redirect('/');
        }

        if ($password !== $password_confirmation) {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Mật khẩu xác nhận không khớp.';
            $_SESSION['data'] = $_POST;
            return redirect('/');
        }

        // ** Kiểm tra email đã tồn tại chưa **
        if ($this->user->checkExistsEmailForCreate($email)) {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = 'Email này đã được đăng ký rồi!';
            $_SESSION['data'] = $_POST;
            return redirect('/');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'dien_thoai' => $dien_thoai,
            'dia_chi' => $dia_chi,
            'thanhpho' => $thanhpho,
            'type' => 'client',
        ];

        $this->user->insert($data);

        $_SESSION['status'] = true;
        $_SESSION['msg'] = 'Đăng ký thành công!';
        return redirect('/');

    } catch (\Throwable $th) {
        // Bạn có thể ghi log lỗi và show lỗi
        $this->logError($th->__toString());

        $_SESSION['status'] = false;
        $_SESSION['msg'] = 'Đã xảy ra lỗi hệ thống!';
        $_SESSION['data'] = $_POST;
        return redirect('/');
    }
}





}