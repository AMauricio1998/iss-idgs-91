<!-- THIS EMAIL WAS BUILT AND TESTED WITH LITMUS http://litmus.com -->
<!-- IT WAS RELEASED UNDER THE MIT LICENSE https://opensource.org/licenses/MIT -->
<!-- QUESTIONS? TWEET US @LITMUSAPP -->
<!doctype html>
<html>

<head>
    <title></title>
    <style type="text/css">
        /* CLIENT-SPECIFIC STYLES */
        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width: 600px) {
            .img-max {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
            }

            .max-width {
                max-width: 100% !important;
            }

            .mobile-wrapper {
                width: 85% !important;
                max-width: 85% !important;
            }

            .mobile-padding {
                padding-left: 5% !important;
                padding-right: 5% !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

    </style>
</head>

<body style="margin: 0 !important; padding: 0; !important background-color: #ffffff;" bgcolor="#ffffff">

    <!-- HIDDEN PREHEADER TEXT -->
    <div
        style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        Estatus de la solicitud finalizada
    </div>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" valign="top" width="100%" bgcolor="#3b4a69"
                style="background: #3b4a69 url('bg.jpg'); background-size: cover; padding: 50px 15px;"
                class="mobile-padding">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 0 0 20px 0;">
                            <img src="https://www.grupoiis.com/wp-content/uploads/2020/12/logoGrupoIIS-bco.png"
                                width="80" height="80" border="0" style="display: block;">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top"
                            style="padding: 0; font-family: Open Sans, Helvetica, Arial, sans-serif;">
                            <h1 style="font-size: 40px; color: #ffffff;">Solicitud finalizada</h1>

                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
        <tr>
            <td align="center" height="100%" valign="top" width="100%" bgcolor="#f6f6f6" style="padding: 50px 15px;"
                class="mobile-padding">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
                <table>
                    <tr>
                        <td align="center" valign="top"
                            style="padding: 0 0 25px 0; font-family: Open Sans, Helvetica, Arial, sans-serif;">
                            <table>
                                <tr>
                                    <td align="center" bgcolor="#ffffff"
                                        style="border-radius: 0 0 3px 3px; padding: 25px;">
                                        <table>
                                            <tr>
                                                <td align="center"
                                                    style="font-family: Open Sans, Helvetica, Arial, sans-serif;">
                                                    <h2
                                                        style="font-size: 20px; color: #444444; margin: 0; padding-bottom: 10px;">
                                                        Código de solicitud: {{ $asunto->codigo_solicitud }} </h2>
                                                    <br>
                                                    <h2>Fecha de creación:
                                                        {{ \Carbon\Carbon::parse($asunto->created_at)->format('Y-m-d') }}
                                                    </h2>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Codígo producto</th>
                                                    <th>Nombre del producto</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th>Categoría</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($nombre as $to)
                                                    <tr>
                                                        <td class="text-center">
                                                            <center>{{ $to->codigo_producto }}</center>
                                                        </td>
                                                        <td class="text-center">
                                                            <center>{{ $to->nombre_producto }}</center>
                                                        </td>
                                                        <td class="text-center">
                                                            <center>{{ $to->cantidad }}</center>
                                                        </td>
                                                        <td class="text-center">{{ $to->nombre_categoria }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
        <tr>
            <td align="center" height="100%" valign="top" width="100%" bgcolor="#f6f6f6"
                style="padding: 0 15px 40px 15px;">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;"
                    style="padding:30px;background:#FFFFFF;">
                    <tr>
                        <td align="center">
                            <img src="https://www.grupoiis.com/wp-content/uploads/2020/12/logo-grupoiis.png"
                                width="200px" height="100px">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top"
                            style="padding: 0; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #999999;">
                            <p style="font-size: 14px; line-height: 20px;">
                                Más que un servicio, una solución
                                <br><br>
                                <a href="https://www.grupoiis.com/" target="_blank">Grupo iiS</a>

                            </p>
                        </td>
                    </tr>

                    <tr>

                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
    </table>

</body>

</html>
