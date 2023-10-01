<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/empresa/cookies.css') }}">

</head>

<body>

    <x-header />
    <x-headersama /> 
    <x-nav />

    <div class="cookies">
        <h2>Política de Cookies</h2>
    </div>

    <div class="politica-cookies">

        <h3>Política de cookies</h3>

        <p>Como todas y cada una de las tiendas virtuales de internet, esta tienda virtual usa cookies para mejorar la experiencia de navegación del usuario. Las cookies nos permite deducir sus preferencias e intereses para pder ofrecerle la expriencia de usuario y navegabilidad que necesita. A continuación encontrará información sobre qué son las cookies, qué tipo de cookies utiliza este portal, cómo puede desactivar las cookies en su navegador o cómo desactivar específicamente la instalación de cookies de terceros y qué ocurre en caso de deshabilitarlas.</p><br>
        <p><b>¿Qué es una cookie?</b></p>
        <p>Una "Cookie" es un pequeño archivo de texto que se almacena en el ordenador del usuario y nos permite reconocerle. El conjunto de "cookies" nos ayuda a mejorar la calidad de nuestra web, permitiéndonos controlar qué páginas encuentran nuestros usuarios útiles y cuáles no.</p>
        <p> Las cookies son esenciales para el funcionamiento de internet, aportando innumerables ventajas en la prestación de servicios interactivos, facilitándole la navegación y usabilidad de nuestra web. Tenga en cuenta que las cookies no pueden dañar su equipo y que, a cambio, el que estén activadas nos ayudan a identificar y resolver los errores, así como también nos permite identificar intereses y poder ofrecer los productos más interesantes para usted. Algunas de estas cookies son imprescindibles, ya que sin ellas la página no puede funcionar correctamente. Otras cookies son muy útiles, pues recuerdan tu nombre de usuario de forma segura, así como tus preferencias, por ejemplo, el idioma. Gracias a las cookies no es necesario que facilites la misma información cada vez que entras en una página.</p><br>
        <p><b>¿Por qué usamos Cookies?</b></p>
        <p>Usamos cookies para ofrecerte una experiencia más personalizada con tus preferencias. De esta manera no tendrás que facilitar la misma información cada vez que visites la página web. Las cookies se usan además para mejorar el rendimiento de la página, ya que hacen más fácil el proceso de compra y te ayudan a encontrar artículos específicos rápidamente.</p>
        <p><b>Tipos de cookie:</b></p><br>
        <p>La información que le proporcionamos a continuación, le ayudará a comprender los diferentes tipos de cookies:</p><br>
        <li type="circle"><b>Cookies de sesión:</b> son cookies temporales que permanecen en el archivo de cookies de su navegador hasta que abandone la página web, por lo que ninguna queda registrada en el disco duro del usuario. La información obtenida por medio de estas cookies, sirven para analizar pautas de tráfico en la web. A la larga, esto nos permite proporcionar una mejor experiencia para mejorar el contenido y facilitando su uso.</li><br>
        <li type="circle"><b> Cookies permanentes:</b> son almacenadas en el disco duro y nuestra web las lee cada vez que usted realiza una nueva visita. Una cookie permanente posee una fecha de expiración determinada. La cookie dejará de funcionar después de esa fecha.</li><br>
        <p>A continuación publicamos una relación de las principales cookies utilizadas en nuestra Web, distinguiendo:</p><br>
        <li type="circle"><b>Las cookies estrictamente necesarias</b> como por ejemplo, aquellas que sirvan para una correcta navegación o las que permitan realizar servicios solicitados por el usuario o cookies que sirvan para asegurar que el contenido de la página web se carga eficazmente.</li><br>
        <li type="circle"><b>Las cookies de terceros</b> como por ejemplo, las usadas por redes sociales, o por complementos externos de contenido.</li><br>
        <li type="circle"><b>Las cookies analíticas</b> con propósitos de mantenimiento periódico, y en aras de garantizar el mejor servicio posible al usuario, los sitios web hacen uso normalmente de cookies "analíticas" para recopilar datos estadísticos de la actividad que se realiza sobre la plataforma.</li><br>
        <p><b>Relación y descripción de las cookies que utilizamos en la página web</b></p>
        <p>La tabla que publicamos a continuación recoge de forma esquematizada las cookies que utilizamos en nuestra página web:</p><br>
        <table>
            <tr>
                <th><b>Cookie</b></th>
                <th><b>Nombre</b></th>
                <th><b>Finalidad/Más información</b></th>
                <th><b>Vencimiento</b></th>
            </tr>
            <tr>
                <td class="tabla-cookie">subministressama.es</td>
                <td class="tabla-nombre">
                    <p>String alfanumeérico aleatorio</p>
                    <p>PHPSESSID</p>
                    <p>prestashopcookieslaw</p>
                    <p>Home_box_cookie</p>
                    <p>Product_box_cookie</p>
                    <p>Category_box_cookie</p>
                    <p>Custom_box_cookie</p><br>
                    <p>(Cookies Propias)</p><br>
                </td>
                <td><b>La aplicación web</b> utiliza serie de cookies básicas para su correcto funcionamiento, ya que las distintas secciones del sitio web, así como su funcionalidad de comercio electrónico se controla a través de datos y preferencias que dependen en todo momento de la sesión activa del usuario que visita el sitio web y de las acciones que efectua sobre la plataforma. </td>
                <td>1-30 días</td>
            </tr>
            <tr>
                <td>Addshoppers</td>
                <td class="tabla-nombre">addshoppers.com</td>
                <td>Esta cookie pertenece al servicio de addshoppers con el que permitimos a nuestros usuarios la posibilidad de compartir nuestro contenido en sus redes sociales.</td>
                <td>1-30 días</td>
            </tr>
            <tr>
                <td>Google Analytics</td>
                <td class="tabla-nombre">
                    <p>_utma</p>
                    <p>_utmb</p>
                    <p>_utmc</p>
                    <p>_utmv</p>
                    <p>_utmx</p>
                    <p>_utmxx</p>
                    <p>_utmz</p>
                    <p>_qca</p>
                    <p>_ga</p>
                </td>
                <td>Hacemos uso de Google Analytics en el sitio web para poder hacer un seguimiento de la actividad realizada en él. Las cookies de Google Analytics recopilan información de registro estándar y datos sobre los hábitos de los visitantes de forma anónima. Más información:developers.google.com (en inglés)</td>
                <td>
                    <p>2 años</p>
                    <p>30 minutos</p>
                    <p>sesión</p>
                    <p>6 meses</p>
                    <p>2 años</p>
                    <p>...</p>
                </td>
            </tr>
            <tr>
                <td>Facebook</td>
                <td class="tabla-nombre">Cookie de terceros</td>
                <td>El almacenamiento local y otras tecnologías parecidas indican cuándo entras en Facebook para que te podamos mostrar amigos a los que también les gusta nuestro sitio o alguna de sus páginas</td>
                <td>6 meses</td>
            </tr>
            <tr>
                <td>Google YouTube</td>
                <td class="tabla-nombre">recently_watched_video_id_list</td>
                <td>Almacena los ajustes de reproducción de Youtube para que no tengas que realizar estos ajustes cada vez que entres en nuestro portal</td>
                <td>Hasta el cierre del navegador</td>
            </tr>
        </table><br>

        <p><b>Garantías complementarias – Gestión de cookies: </b> Como garantía complementaria a las anteriormente descritas, el registro de las cookies podrá estar sujeto a su aceptación durante la instalación o puesta al día del navegador usado, y esta aceptación puede en todo momento ser revocada mediante las opciones de configuración de contenidos y privacidad disponibles. Muchos navegadores permiten activar un modo privado mediante el cual las cookies se borran siempre después de su visita. Dependiendo de cada navegador este modo privado, puede tener diferentes nombres. A continuación encontrará una lista de los navegadores más comunes y los diferentes nombres de este “modo privado”:</p><br>
        <p><b>Internet Explorer 9</b> y superior: InPrivate</p><br>
        <p><b>Safari 2</b> y superior: Navegación Privada</p><br>
        <p><b>Opera 10.5</b> y superior: Navegación Privada</p><br>
        <p><b>FireFox 3.5</b> y superior: Navegación Privada</p><br>
        <p><b>Google Chrome 10</b> y superior: Incognito</p><br>
        <p>Por otra parte, y si así lo desea, puede navergar por nuestro sitio de la manera habitual pero desactivando las cookies en su navegador. A continuación le orientamos en el proceso a seguir para desactivarlas en su navegador.</p><br>
        <p><b>¿Cómo puedo desactivar las cookies?</b></p>
        <p>Modificar las preferencias de tu navegador para desactivar las cookies es muy sencillo, pero recuerda que en estos casos, algunas funcionalidades de la tienda virtual no estarán disponibles para ti.</p><br>

        <p><b>Firefox</b></p>
        <li type="disc">Abre Firefox.</li>
        <li type="disc">Pulsa la tecla «Alt» del teclado.</li>
        <li type="disc">En el menú que aparece arriba en la pantalla, elige «Herramientas» y después «Opciones».</li>
        <li type="disc">Haz clic en «Privacidad».</li>
        <li type="disc">En «Firefox podrá»: elige «Usar una configuración personalizada para el historial». Desmarca la opción «Aceptar cookies» para desactivarlas y guarda los cambios realizados.</li><br>

        <p><b>Internet Explorer</b></p>
        <li type="disc">Abre Internet Explorer.</li>
        <li type="disc">Haz clic en el botón «Herramientas» y después en «Opciones de internet».</li>
        <li type="disc">Selecciona «Privacidad».</li>
        <li type="disc">En «Avanzada» puedes desactivar las cookies y guardar los cambios realizados.</li><br>

        <p><b>Google Chrome</b></p>
        <li type="disc">Abre Google Chrome.</li>
        <li type="disc">Haz clic en el menú «Herramientas».</li>
        <li type="disc">Selecciona «Opciones».</li>
        <li type="disc">Haz clic en la pestaña «Avanzada». En la sección «Privacidad», haz clic en «Configuración de contenido».</li>
        <li type="disc">En la pestaña «Cookies» puedes deshabilitar las cookies y guardar los cambios seleccionados.</li><br>

        <p><b>Safari</b></p>
        <li type="disc">Abre Safari.</li>
        <li type="disc">Selecciona «Preferencias» en el menú y haz clic en «Seguridad» (parte superior derecha).</li>
        <li type="disc">En la sección "Aceptar cookies", puedes elegir si Safari debe aceptar las cookies de los sitios a los que entras. Para obtener más información, haz clic en el signo de interrogación.</li>
        <li type="disc">Para ver las cookies que se han almacenado en tu ordenador, haz clic en «Ver cookies».</li><br><br>

        <p><b>Importante:</b> Por favor, lea atentamente la sección de ayuda de su navegador para conocer más acerca de cómo activar el “modo privado”. Podrá seguir visitando nuestra web aunque su navegador esté en “modo privado”, <b>si bien, su navegación por nuestra web puede no ser óptima y algunas utilidades pueden no funcionar correctamente.</b></p><br>
        <p>Por último indicar que nosotros podemos modificar esta Política de Cookies en función de exigencias legislativas, reglamentarias, o con la finalidad de adaptar dicha política a las instrucciones dictadas por la Agencia Española de Protección de Datos, por lo que se aconseja a los usuarios que la visiten periódicamente.</p><br><br>

    </div>

    <x-footer />

</body>

</html>