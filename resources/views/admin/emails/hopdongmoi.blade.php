<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-height: 60px;
        }
        .btn-primary {
            display: inline-block;
            padding: 10px 18px;
            background-color: #0d6efd;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .footer {
            margin-top: 40px;
            font-size: 0.9rem;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="logo">
            <img src="{{ url('user/assets/img/bGROUP_white.png') }}" alt="Logo Công ty BGroup">
        </div>

        <p>Xin chào <strong>{{ $user->name }}</strong>,</p>

        <p>Chúng tôi xin thông báo rằng <strong>hợp đồng thuê văn phòng</strong> của bạn đã được tạo thành công với thông tin như sau:</p>

        <ul>
            <li><strong>Thời gian thuê:</strong> từ <strong>{{ $hopDong->ngay_bat_dau }}</strong> đến <strong>{{ $hopDong->ngay_ket_thuc }}</strong></li>
        </ul>

        @if (isset($user))
            <p>Thông tin đăng nhập của bạn:</p>
            <ul>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Mật khẩu:</strong> {{ $user->cccd }}</li>
            </ul>
        @endif

        <p>Nếu bạn cần hỗ trợ thêm, đừng ngần ngại liên hệ với chúng tôi.</p>

        <p>Trân trọng,<br><strong>BQL Tòa nhà BGroup</strong></p>

        <div class="footer">
            <p>Đây là email tự động, vui lòng không phản hồi lại email này.</p>
        </div>
    </div>
</body>
</html>

