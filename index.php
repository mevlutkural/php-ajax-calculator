<?php
@include(__DIR__ . '/csrf.php');

$token = $_SESSION['csrf_token'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hesap Makinesi</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body class="pt-5">
    <div id="app" class="container-fluid position-relative pt-5">
        <div id="resultBox" style="display:none" class="alert alert-primary position-absolute start-50 top-0 translate-middle-x z-3"></div>
        <div class="container card mt-5 p-3">
            <div class="text-center">
                <h2 id="title">Hesap Makinesi</h2>
            </div>
            <div class="col-md-6 col-sm-12 mx-auto">
                <form id="calculator" method="POST">
                    <input type="hidden" name="_token" value="<?php echo $token ?>">
                    <div class="mb-2">
                        <label for="n1" class="form-label">1.Sayı</label>
                        <input type="number" name="n1" id="n1" class="form-control">
                    </div>
                    <div class="mb2">
                        <label for="option" class="form-label">İşlem</label>
                        <select name="option" id="option" class="form-select">
                            <option value="+">toplama</option>
                            <option value="-">çıkarma</option>
                            <option value="*">çarpma</option>
                            <option value="/">bölme</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="n2" class="form-label">2.Sayı</label>
                        <input type="number" name="n2" id="n2" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="custom" class="form-label">Faktoriyel (1.sayı)</label>
                        <input type="checkbox" id="custom" name="custom" value="1" class="form-check-input">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Hesapla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        $('form#calculator').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'calculator.php',
                data: $(this).serialize(),
                success: function(res) {
                    if (res == 'Hatalı giriş.' || res == 'Token hatası') {
                        $('#resultBox').removeClass('alert-primary').addClass('alert-danger');
                    } else {
                        if ($('#resultBox').hasClass('alert-danger')) {
                            $('#resultBox').removeClass('alert-danger').addClass('alert-primary');
                        }
                    }
                    $('#resultBox').text(res);
                    $('#resultBox').fadeIn('slow');
                    setTimeout(function() {
                        $('#resultBox').fadeOut('slow');
                    }, 3000);
                }
            });
        });
    </script>
</body>

</html>