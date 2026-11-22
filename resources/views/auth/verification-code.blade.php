<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode verifikasi HerPlay</title>
    <style>
        @media only screen and (max-width: 480px) {
            .px { padding-left: 22px !important; padding-right: 22px !important; }
            .h1 { font-size: 24px !important; }
            .code { font-size: 32px !important; letter-spacing: 8px !important; }
            .logo { width: 170px !important; }
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color:#dfeae6; -webkit-text-size-adjust:100%;">

    <div style="display:none; max-height:0; overflow:hidden; opacity:0;">
        Kode kamu {{ $code }}. Berlaku 10 menit.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#dfeae6" style="background-color:#dfeae6;">
        <tr>
            <td align="center" style="padding:36px 12px;">

                <table role="presentation" width="560" cellpadding="0" cellspacing="0" border="0" style="width:100%; max-width:560px;">

                    <!-- LOGO -->
                    <tr>
                        <td align="center" bgcolor="#f5fbf9" style="background-color:#f5fbf9; padding:30px 32px 22px 32px; border-radius:14px 14px 0 0;">
                            <img class="logo" src="{{ $message->embed(public_path('images/herplay-logo1.jpeg')) }}"
                                 alt="HerPlay PS Rental" width="200"
                                 style="display:block; width:200px; max-width:100%; height:auto; border:0;">
                        </td>
                    </tr>

                    <!-- PITA HERO -->
                    <tr>
                        <td class="px" bgcolor="#0f2f44" style="background-color:#0f2f44; padding:34px 40px 36px 40px; border-top:4px solid #17a34a;">
                            <div style="font-family:Arial,Helvetica,sans-serif; font-size:12px; font-weight:700; letter-spacing:3px; color:#4ade80; text-transform:uppercase;">
                                Verifikasi email
                            </div>
                            <h1 class="h1" style="margin:12px 0 0 0; font-family:Arial,Helvetica,sans-serif; font-size:28px; line-height:1.3; font-weight:700; color:#ffffff;">
                                Hai {{ $name }}, satu langkah lagi sebelum kamu bisa sewa.
                            </h1>
                        </td>
                    </tr>

                    <!-- ISI -->
                    <tr>
                        <td class="px" bgcolor="#ffffff" style="background-color:#ffffff; padding:34px 40px 8px 40px; font-family:Arial,Helvetica,sans-serif; color:#0f2f44;">

                            <p style="margin:0 0 24px 0; font-size:15px; line-height:1.75; color:#44596a;">
                                Terima kasih sudah daftar di HerPlay. Masukkan kode di bawah
                                di halaman verifikasi untuk mengaktifkan akunmu.
                            </p>

                            <!-- KODE -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" bgcolor="#0f2f44" style="background-color:#0f2f44; border-radius:12px; padding:26px 12px 24px 12px;">
                                        <div style="font-family:Arial,Helvetica,sans-serif; font-size:11px; font-weight:700; letter-spacing:4px; color:#4ade80; text-transform:uppercase;">
                                            Kode kamu
                                        </div>
                                        <div class="code" style="margin-top:14px; font-family:'Courier New',Courier,monospace; font-size:42px; font-weight:700; letter-spacing:14px; color:#ffffff; padding-left:14px;">{{ $code }}</div>
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin:16px auto 0 auto;">
                                            <tr>
                                                <td width="48" height="3" bgcolor="#17a34a" style="background-color:#17a34a; font-size:0; line-height:0; border-radius:2px;">&nbsp;</td>
                                            </tr>
                                        </table>
                                        <div style="margin-top:14px; font-family:Arial,Helvetica,sans-serif; font-size:13px; color:#9fb4c2;">
                                            Berlaku <b style="color:#ffffff;">10 menit</b>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- LANGKAH -->
                    <tr>
                        <td class="px" bgcolor="#ffffff" style="background-color:#ffffff; padding:26px 40px 8px 40px; font-family:Arial,Helvetica,sans-serif;">
                            <div style="font-size:12px; font-weight:700; letter-spacing:3px; color:#17a34a; text-transform:uppercase; margin-bottom:16px;">
                                Cara pakai
                            </div>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td width="34" valign="top" style="padding-bottom:14px;">
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr>
                                            <td width="26" height="26" align="center" bgcolor="#e6f6ec" style="background-color:#e6f6ec; border-radius:13px; font-size:13px; font-weight:700; color:#17a34a;">1</td>
                                        </tr></table>
                                    </td>
                                    <td valign="top" style="padding-bottom:14px; padding-top:3px; font-size:14px; line-height:1.6; color:#0f2f44;">
                                        Kembali ke halaman verifikasi di HerPlay.
                                    </td>
                                </tr>
                                <tr>
                                    <td width="34" valign="top" style="padding-bottom:14px;">
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr>
                                            <td width="26" height="26" align="center" bgcolor="#e6f6ec" style="background-color:#e6f6ec; border-radius:13px; font-size:13px; font-weight:700; color:#17a34a;">2</td>
                                        </tr></table>
                                    </td>
                                    <td valign="top" style="padding-bottom:14px; padding-top:3px; font-size:14px; line-height:1.6; color:#0f2f44;">
                                        Ketik 6 angka di atas, lalu klik <b>Verifikasi</b>.
                                    </td>
                                </tr>
                                <tr>
                                    <td width="34" valign="top">
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr>
                                            <td width="26" height="26" align="center" bgcolor="#e6f6ec" style="background-color:#e6f6ec; border-radius:13px; font-size:13px; font-weight:700; color:#17a34a;">3</td>
                                        </tr></table>
                                    </td>
                                    <td valign="top" style="padding-top:3px; font-size:14px; line-height:1.6; color:#0f2f44;">
                                        Akunmu aktif. Pilih console dan mulai sewa.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- KEAMANAN -->
                    <tr>
                        <td class="px" bgcolor="#ffffff" style="background-color:#ffffff; padding:26px 40px 38px 40px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td bgcolor="#f5fbf9" style="background-color:#f5fbf9; border-left:4px solid #17a34a; border-radius:6px; padding:16px 18px; font-family:Arial,Helvetica,sans-serif; font-size:13px; line-height:1.7; color:#5b6f7d;">
                                        <b style="color:#0f2f44;">Jangan bagikan kode ini.</b>
                                        Tim HerPlay tidak pernah minta kode lewat chat atau telepon.
                                        Kalau kamu tidak merasa daftar, abaikan email ini. Akun tidak akan aktif.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td align="center" bgcolor="#0b2233" style="background-color:#0b2233; padding:24px 32px 26px 32px; border-radius:0 0 14px 14px; font-family:Arial,Helvetica,sans-serif;">
                            <div style="font-size:14px; font-weight:700; letter-spacing:1px; color:#ffffff;">
                                her<span style="color:#4ade80;">play</span>
                                <span style="font-weight:400; color:#7f97a8;">&nbsp;&middot;&nbsp;PS Rental</span>
                            </div>
                            <div style="margin-top:10px; font-size:11px; line-height:1.7; color:#6f879a;">
                                &copy; {{ date('Y') }} HerPlay. Semua hak dilindungi.<br>
                                Email otomatis, tidak perlu dibalas.
                            </div>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>