<h2>Thống kê tồn kho sản phẩm</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>id</th>
        <th>Tên sản phẩm</th>
        <th>Kích cỡ</th>
        <th>Giá</th>
        <th>Số lượng tồn kho</th>
    </tr>
@foreach ($data as $item)
    <tr>
        <td>{{ $item['ma_san_pham'] }}</td>
        <td>{{ $item['ten_san_pham'] }}</td>
        <td>{{ $item['kich_co'] }}cm</td>
        <td>{{ number_format($item['giaban'] ?? 0) }}
</td>
        <td>{{ $item['so_luong_ban_thang'] }}</td>
        <td>{{ number_format($item['doanh_thu']) }}</td>
        <td>{{ $item['ton_kho'] }}</td>
    </tr>
@endforeach


</table>
