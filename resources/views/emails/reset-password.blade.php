<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f1f5f9; padding: 40px 20px; }
        .wrapper { max-width: 540px; margin: 0 auto; }
        .card { background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
        .header { background: linear-gradient(135deg, #004a80 0%, #1e3a8a 100%); padding: 32px 40px; text-align: center; }
        .header h1 { color: #fff; font-size: 20px; font-weight: 800; }
        .header p { color: rgba(255,255,255,0.65); font-size: 11px; margin-top: 4px; letter-spacing: 2px; text-transform: uppercase; }
        .body { padding: 36px 40px; }
        .greeting { font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 14px; }
        .text { font-size: 14px; color: #64748b; line-height: 1.7; margin-bottom: 14px; }
        .btn-wrap { text-align: center; margin: 28px 0; }
        .btn { display: inline-block; background: #004a80; color: #fff !important; text-decoration: none; padding: 15px 36px; border-radius: 50px; font-size: 15px; font-weight: 700; }
        .info-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; font-size: 12px; color: #64748b; line-height: 1.6; }
        .url-box { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 10px 14px; margin-bottom: 20px; word-break: break-all; font-size: 11px; color: #3b82f6; font-family: monospace; }
        .divider { border: none; border-top: 1px solid #e2e8f0; margin: 20px 0; }
        .warning { font-size: 12px; color: #ef4444; font-weight: 600; }
        .footer { background: #f8fafc; padding: 20px 40px; text-align: center; font-size: 11px; color: #94a3b8; line-height: 1.6; }
        .footer a { color: #004a80; text-decoration: none; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <div class="header">
                <h1>Portal Alumni Polije</h1>
                <p>Politeknik Negeri Jember</p>
            </div>
            <div class="body">
                <p class="greeting">Halo, {{ $user->username }} 👋</p>
                <p class="text">Kami menerima permintaan reset password untuk akun admin Anda di <strong>Portal Alumni Politeknik Negeri Jember</strong>.</p>
                <p class="text">Klik tombol di bawah untuk membuat password baru:</p>
                <div class="btn-wrap">
                    <a href="{{ $resetUrl }}" class="btn">🔐 &nbsp; Reset Password Saya</a>
                </div>
                <div class="info-box">
                    ⏱ &nbsp; Link ini hanya berlaku selama <strong>60 menit</strong> sejak email ini dikirim.
                </div>
                <p class="text">Jika tombol tidak berfungsi, salin URL berikut ke browser:</p>
                <div class="url-box">{{ $resetUrl }}</div>
                <hr class="divider">
                <p class="text">Jika Anda <strong>tidak merasa</strong> meminta reset password, abaikan email ini. Password tidak akan berubah.</p>
                <p class="warning">⚠️ Jangan bagikan link ini kepada siapapun.</p>
            </div>
            <div class="footer">
                <p>Email ini dikirim otomatis. Mohon jangan membalas email ini.</p>
                <p style="margin-top:6px;">© {{ date('Y') }} Politeknik Negeri Jember &nbsp;·&nbsp; <a href="{{ url('/') }}">Portal Alumni</a></p>
            </div>
        </div>
    </div>
</body>
</html>
