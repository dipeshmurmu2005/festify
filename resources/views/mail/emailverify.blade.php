<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Verify Your Email - Festify</title>
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f9f9f9;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f9f9f9; padding:40px 0;">
        <tr>
            <td align="center">

                <!-- Container -->
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08);">

                    <!-- Header / Branding -->
                    <tr>
                        <td style="padding:30px; text-align:center; background:#f05537;">
                            <h1 style="margin:0; font-size:28px; color:#ffffff; font-weight:700;">Festify</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:40px; text-align:center;">

                            <!-- Greeting -->
                            <h2 style="font-weight:300; color:#333; margin:0;">Hello <span
                                    style="font-weight:600;">{{ $fullname }}</span>,</h2>
                            <p style="margin:20px 0; font-size:16px; line-height:1.6; color:#555;">
                                Welcome to <strong>Festify</strong> — the platform where you can
                                <strong>create and manage events</strong>, connect with <strong>service
                                    providers</strong>,
                                and even <strong>book event tickets</strong> with ease.
                            </p>

                            <p style="margin:20px 0; font-size:16px; line-height:1.6; color:#555;">
                                To get started, please confirm your email address by clicking the button below:
                            </p>

                            <!-- Button -->
                            <a href="{{ $verificationURL }}"
                                style="text-decoration:none; display:inline-block; margin:20px 0;">
                                <button
                                    style="background-color:#f05537; border:none; padding:14px 28px; border-radius:6px; font-size:16px; font-weight:600; color:#fff; cursor:pointer;">
                                    Verify Email
                                </button>
                            </a>

                            <!-- Footer Note -->
                            <p style="margin-top:30px; font-size:14px; color:#999; line-height:1.5;">
                                If you didn’t create an account on Festify, you can safely ignore this email.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:20px; text-align:center; background:#f9f9f9; border-top:1px solid #eee;">
                            <p style="margin:0; font-size:12px; color:#999;">
                                © {{ date('Y') }} Festify. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- End Container -->

            </td>
        </tr>
    </table>

</body>

</html>
