</div>
<div class="container-fluid bg-info">

    <div class="row">

        <div class="col-lg-12">

            <p class="text-center">
                <b>Supermercado Online</b>
            </p>
            <p class="text-right" style="margin-top: -30px;">
                <b>Bem vindo: </b><?php echo $_SESSION['login']['nome_pessoa'] ?>
            </p>

        </div>

    </div>

</div>

</body>
<?php
include_once dirname(__DIR__) . '/footer_html_section.php';
