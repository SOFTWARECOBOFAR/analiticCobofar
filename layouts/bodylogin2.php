<?php 
//header('Content-Type: text/html; charset=iso-8859-1');
?>

<!DOCTYPE html>
<html lang="en">
<!--ESTE ES EL DOCUMENTO DEL BODYLOGIN -->

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Monitoreo - COBOFAR
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link href="../assets/autocomplete/awesomplete.css" rel="stylesheet" />
  <link href="../assets/autocomplete/autocomplete/autocomplete-img.css" rel="stylesheet" />
  <link href="../assets/css/style.css" rel="stylesheet" />
</head>

<body class="off-canvas-sidebar">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      
    </div>
  </nav>
  <!-- End Navbar -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> -->
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  
  <!-- Forms Validations Plugin -->
  <script src="../assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="../assets/js/plugins/moment.min.js"></script>
 <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../assets/js/plugins/sweetalert2.js"></script>
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <script src="../assets/js/plugins/dataTables.fixedHeader.min.js"></script>

  <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <script src="../assets/js/material-dashboard.js?v=2.1.0" type="text/javascript"></script>
  <script src="../assets/js/mousetrap.min.js"></script>
   
  <script src="../assets/autocomplete/awesomplete.min.js"></script>
  <script src="../assets/autocomplete/autocomplete/autocomplete-img.js"></script>
  <!--CHART GOOGLE-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
  <script src="../assets/alerts/alerts.js"></script>
  <script src="../assets/alerts/functionsGeneral.js"></script>

  <script>
    var imageLogo="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8QEA0PDxAPDw8QDw8NEA8PDQ8NDxAOFREWFhURFRUYHSogGBolGxYVITEhJSkrLi4uGB81ODMtNyguLisBCgoKDg0OGxAQGjAmICYtLzUuMi0vLy01LS0vLS0tLS0tKy0tLS0tLS4tLy0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAOEA4QMBEQACEQEDEQH/xAAbAAACAgMBAAAAAAAAAAAAAAAAAQIDBAUGB//EAEcQAAICAgADBQUEBgUJCQAAAAECAAMEEQUSIQYTMUFRByJhcYEUMlKRI0KSobHhYnKC0fAVJDM1Q1N0ssEWF0SEk6Kz0vH/xAAaAQEAAgMBAAAAAAAAAAAAAAAAAQQCAwUG/8QANREBAAIBAgQDBQgBBAMAAAAAAAECAwQREiExQQUTUWFxgZGxIjIzQqHR4fDBI0NTghQVFv/aAAwDAQACEQMRAD8A9ogEAgMCAGAoCgOAQCAQCBEmAoDgMQCAQHAIBAICgOAQCAQCAQCAQJKsAMCJgKAQHAIBAIESYCgEBwHAIDgEAgEBQCA4BAIBAIBAIE1XzMAJgRJgRgEBwCAQCBEmAoBAcBwCAQHAIBAiTAcBwCAQCAQCAQJonmYEiYFZMCBMBwCA4BAIEWaAoBAIEhAIBAcAgECJMAEBwHAIBAIBAIBAuYwK2MCBMBCA4DEAgECDNAQgV5OVXUOa2xK1/FY6oPzMiZiOrOmO952rEz7mmyO2fDE8cuo/1Oe3/lBmuc2OO65TwvV26Y5+PL6pYPa/BvIFNllm+m1xMrl/a5NRXNW3T6Mc3h+fD+JER/2r+7eqQQCPA9ZtUjgOAQCBEmACA4DgEAgEAgEAECfdmAMYFRMBQGIDgOAQIM0DW8b43j4VfeZD8u+iIPessPoq+fz8B5zC+StI3lZ02ky6m/Djj9o97zLjvtDy7iVx9YtXqNPcR8XPRfoPrKWTU2npyeo0vgmDHzyfan9Pl3/vJicE7I5mcwttLqp6m24s9rD4c3XXxJ+QMUwWvzsnVeLYNLHl44iZ9I5RHv2/w9C4P2EwqNFk71x+s/v9fhvoPoBLdMNK9Iee1HimpzcpttHpHJ0tWLWv3UUa+HX85tc7qugEAgECBO4AIEoDgEAgEAgEAgXKuvnAOaBjkwFAIEhAcAgQZoGk7Vdoa8CnvG09r7Wmrei7+p9FHTZ/6masuWKRuu6HQ31eThjpHWfT+XinE+I3ZNr3XuXsbz8lHkqjyUek5trTad5e4wYMeCkUxxtEf3eXedh+xO+XJyl6/eSsj7vxI82/h8/C7h0+32rPN+KeLTeZxYZ5d59fd7HpNdYUaUAD0EtPPLPj5RM7DX5fF6k6D3j8PD85Ty67HTlHNaxaPJfnPJrbe0L/AKqKPnsylbxK/aIXK+H17ygvaKzzVfyP98iPEcneIZT4dTtLMx+0FZ++pX4j3h+Xj/GWcfiNJ+9Gytk0F6/d5tnXergMhDL6g7Ev1tFo3iVG1ZrO0piZISEBwCAQCAQCAAQLkXXzgRdoEOaBXAIDECQgECDNArttVFZ3IVEUuzHoFUDZJ+kiZ25sq1m0xWOsvCO03Gnzcmy9thN8lKH9SkH3R8z4n4mcvJkm9t3vdDpI02GMcde/tlu/Z32e+03d/YP0VR93Y6NYPP6dPqfhN2mxbzxS5vjeu8qnk0nnbr7I/n6PX0UAAAaA6AfCX3kk2IUFj0A6yLWisbymImZ2hznFeKs5Kr0X/HjOJqdXbJO1ejsafSxSN56tQTuUV0QIkQlEiErcfLsqbnrOj+sp+649CJvwai+Kd46K+fT1yxzdbwviCZCB06EdHQ+KN6H++d/FlrkrxQ4eXHbHbhlmTY1nAIBAIBAIFyLr5wIu8ComAtwFAIEhAcCDNAQEDVdqeG25WLbj02Co2coZipbdYOyviPHQHy3NeWk3rwxK3otRTBmjJau+31ef/wDdhlf7+r/0z/8AaVf/ABJ9Xe/+hx/8c/OP2eg9mOEDExq6OhZR7zDpzN5n6nZ+suUrFKxWHntVqJ1Ga2Se8/L2NyqzJXaTj+br3B5fxnK1+f8AJDpaLD+aXPTluoICjYECJkJhGEpYOacW9LP9k+ktHly/i+Y8fzl3R5uC+3ZS1mHjpv3h3wndcQQCAQCAAQLlXXzgRd4FJMAgGoCgMQJQIMYC1AcAgOBNE84DtflDN6At+QkWtwxMpiN52cXxByW6/X5+c83ltvbd6DDXarGmptEkEkKJCMhMIGQlRxBN1t8OsyrO0sbRvDtOzGV3uJQx8Qvdn+z0H7tT0eC3FSJeezV4bzDZza1CAQFAtUa+cBO8ComAQAQHAUBiBFjAUBwCAxAsRPMwJkwMXP8A9Fbrx5G8fDwmrNG+O3uZ452vHvcPc9pYkooPp3nh+6ebmd5d2t9o22R/S/gX9v8AlMWXHPoP0v4F/b/lJ3PMn0H6X8C/t/yk7nmT6F+l/Av7f8pG55k+gIt/Av7f8oPM9iJW38K/twnzJ9Eba7GUryqN+fPETsjzJ9HUdjaeTFA51c94++Ug8p6DlOvPpv6zv6Kd8US4uq/EbyW1cQFAmo1AHeBVuAQGBAcAgAEBMYEYDgEAgXVp5mBMmBAwKshOZHX8SlfzExvG9ZhlWdrRLiMse+T66M81kja0vRYp3qgJgyOSkSAQCSEZAoucKrsfIEyYjediZ2dJ2FxymFUSNG1rLj8mbp+4Cei09dscPP6i2+SW+Jm9oECQgJmgVwHAeoDgOAQIkwFAIBAIFtVfmYFpMCBgRJgIwOW49i8rkjwbbD6+I/P+M4uvw8NuKOkuxoc29eGWpUznr6W4QckEgKSIkyEsLIpbItqw6/GxgbGH6lQ+8x+ktaTDN7q+pyxSj0eqtUVEQaVFVFHooGgPynfiNo2cGZ3ncrrAqsx8FBJkoc5/25xPw2/szb5NnL/9xpfWfk2vB+N1ZSu1QcBGCnmGhsjfT/HpMLUmvVb02qx6iJnH2Z8xWTgOA4BAcAgQgEBQGIFtVfmYFpMCBMCJMBQEBuBVm4i2oUPTzVvMN6zXkx1yV4ZZ47zS28ONzcVqnKONHyPkw9QZwM+C2K209HdwaiuWOXVj7mhvPmg2HNBsW4SxcnLIIqqU23v7qIvU7+M24sVsk7NWTJFI3l1nZjgX2VGewh8m3RsfxCjyrX4D9/5TvYMMYquHnzTkt7G7m9ocn264wK6/s6H37Pva8l8/8f3TbipvO7leLauMWLgrP2rfTu8/rQsVVQSzEKoHiSToAS28pWs2naOr1ngHDBjUV1frfec+th6n+75ASje3FO722j00afDFO/f3tlMVo4DgEBwJIu/lAt7sQMWAoDgW1V+Z8IFpMCJMCBMBGAgNwLANQEYGPl4qWryWKGH7wfUHyMxtSLxtZlW81neHO5fZu4bNDrYv4LfdYfAMOh/dObl8OjrSXQx+Idrw1V2JlJ97Eu+aAWD/ANsp20WWOy3GsxT3VCvJPRMPIJ/pJyD8zEaPLPZM6vFHdk0dnM67/StXip5hT3tuvp0H5y1j8Pn8ytk18fldLwfgmPiA90pLt961zzWN8z5D4CdLHirTo52TLa87y2M2NbT9oOO14qHruw9FUeO5lSk2nkq6vV009OK3XtHq8vzMprXaxztmOz8PgJdrWIjaHjc+e+a83v1l2vYrs6U1lXjTkfoqyOqgj77fH0Hl/Cvlyb8od/wrw+af62SOfaP8uymh3TEBwCA4DRd/KBcOkA3AxNwCBdVX5nwgWkwIkwIkwImAKNwLNagIwImAKu4Fvh4QK2aBEmBEmBRkZVdYJsdVA6nZkxCLWisby5PjXbVRtMYcx8Oc/dHy/wAfWbaYpnq4+q8Yx0+zi+1P6fy5GmjJzLCVV7nPif1V+Z8FE3/ZpDgxXPq8m/OZ/vydt2e7IJSVtvK22jqqjrWh9ev3j8f/ANmi+WZ5Q7+i8Jrinjy87fpH7upml2DAgOAQHAaLv5QLRACYC3AxgIF1VfmfCBYTARMCJMCMAUbgW61ARgQMAA3As3qBAmBEwIkwNTncPybN8mWagfIUKT+fN/0mUTEdYVsuPNb7l9vh/LUWdihYd3ZV1n9lV/Le9TZ5u3SFG/hU5Z3y5Zlm4nZDCr0TW1pH+9ckfsjQP1ExnLaW3F4Tpqc+Hf3y3dVSoAqKqKPBVUKB9BNe7oVrFY2rG0JwyPUBwCA4Aq7gWwCAoBuBCtPM+EC0mBGAiYHNcd7ccPwrjj5FjraFVyq0W2DlbwOwNTdj0+S8b1gX9me1WJxFrlxWsY0isvz1NWNPzcut+P3TIyYbY9uLuNpxrilOFj25N5IrqXmOhtmPgFUebEkAD4zClJvaKwL8XKS6uu2pg9diLYjqdhkYbBH0kTExO0jB49xvHwau/wAlilXOte1rew8zb0NKCfIzKlLXnao0eP7R+EOQPtXJvzsovrX6krofWbJ0uWOw6ui9HRXrZXRgGV0YMrKfAgjoRNExt1GJbxWlcivEZwL7KnvRPWtCAevr18P6Leky4Z4eLsHxLiFOPWbr3WusFFLN4bZgqj8yJFazadoGQxkCm+5K0eyxgiIrO7sdBVA2SfpJiN52gYvBOLU5lFWTQxauwbGxplIOirDyYHpqZXpNLcMjOmA0XGe1/D8RxXfkKLSQO6QG113+IL9z66m2mG943iBsOM8Vpw6XyMhilKFAzBGsILOEXoo2erCY0pa88Neor7P8dxs6prsV2etbDSS1b1nnCqxGmAPgy9YyY7UnawyuJZ1ePTbfc3LXUjWOfgB4AeZPgB6mY1rNp2gPhudXkU1X0tzV2oHQ/A+R9CDsEeoMm1ZrO0izKya6key10rrQczO7BEUepJ6CRETM7QNLwXthgZmQ2NjWm2xa2tJFbqhRWUHTMBvqw8JsvgvSvFaB0YmoEA3AaruBPlECEBbgRJgKB4f7VXVeMozrzoteI716B50DEsmj47AI+s6ml/B+Y9E9nPFMHJGW2Hw9MDkNS2ctNVTW7DFd8gG9dfH1lPUVvWY4rbjkvaFxJ+KcRo4RjOFqqsPfWE+53wUl2PqEXY+LEj0m/BWMVJySLPZL2jam2zhGUdFXsGPs7C2qT3lIPmDosP7XqI1WKJjzK/Ebz2zf6s/81R/B5q0f4g8z4rdijhPC6hQozLHyLjk92K90LfcnIbP1+vL037oA3rYl2sW82078uX0Hs/YXhDYeBi47WLYwDWMyNzV7scvpD5qObW/Px85zc9+O82geM9peP338Sv4ljluXGurSmwDapWpK171+q5DnXnzkec6WLHEY4pPcZ3bztY/Fe6rx67Bj0Ufar01/teUc7N/RTfKD58xPpMcGGMXOes9P77R6R7NuOfbMCos3NdR/m1pPUkqByufXa8p367lHU4+C8+kjnvazx13anhOMd23tWb9HXRm/R1E+Wzpj8APIzfpMe2+S3YajsTxR+EcRv4bkurY9tgQWA+4tpA7u4egYEA+nT0M2ZqRmxxevUdl7UeP24WGO4JW7Is7hbB0Na8pZmHo2hoem9+UraXHF78+w5f2d9gcXKxlzczmv71rOWnnZUAVypZyDtmJB8/zm/Uam1bcNeQ6r2sKBwfLA8A2IB5/+KqmjSfix8foMD2Kf6vv/AONt/wDhpmWs/E+CIar2mcWfNy8bg2M3TvazkNvS94eoU+qou3I9deYmzTU4Kzlt8Esf2accbBy7+E5TDka50pbe1XI34A/hsGiPjr8UnU4+OkZKjofa1wXMy8ag4oaxabHstoT7zggBXA/WK6bp4+908Jp0mStLTxDnvZX2hw0upw7MKqnLIalMxKx3tjdSa7SRzKTrXQ62NaE3arHeYm0W3j0HsG5zwbgNV3AtgECjcAgKAKNwPOu1/YnNyuK0ZtIp7itsMtz2lX1VZzNpdenxlzFnpTFNZ68x6HxFLWqtWl1qtat1rsZOdUcjQYrsb0esqRtvzHlPZ/2R8/fniVtoYWar+zW1stqa2bGZ0J6k+HQ9Dvxl7JrdtuCPmHxr2VWJfiNwy01oOtlt9gL0WIwK2LyqOb5DzUevRTVxNZ8yB1vb/gWTm4CY1Rre8WUu7Me5RuVTzMB11sneusr4MlaX4p6DT19g7LOC1YF/drl0NfbS6NzKtjWuwXm191lYA/n5CbJ1ERm446DK7NdnOI43CsjFbIT7RbW60IxJrxeddFO8AJPiT0GgfDYmOXLjtli23L6jG7DdiDj4WdjZ1a82U/duEcN+gVdIysPAhizDzHSZZ9RxXi1ewz+xnYmrBx8iq0rdZk89dz60DR1VawD4DlOz8T8BMM2om9omOw1ns47IZ3D78p7XqFDhqlTmLvYUc93cddFGt9N797y1NmozUyViI6jWY3sxvyMzLs4lezVue9W7GZFa6xmOwVdW5AANcuvNdHoZnOritIikfMHaT2ToK6v8nF2s7zlsXJtQL3ZH39qo1o66a6gn0jHrJ3+2Os4l2ROXw6nCy7+8vqCsuUteiLVBCsVJ94cp5T1G+p6Hwr1zcGSbVjl6DiMTsd2iwedMO9e7Zt/oshAh/pclo0p+X5y1OfBfnaB2/abguZmcHGIeQ5r1YXel3AQ3VvU9p5gPVW8BK2LJWmXi7cxX7POz+VgYWRRcalufIttrZSbkUNTWqlh037ynp++NRkrkvEx0HK8H9lL2WZTcTusPvg1vj2Vk3liS9j86HXUjpodd+UsX1kREcEfMPj/soION/k12HvlbjkWgd2PFbVKqD00RoDeyvxMjHrOvGO07R4vFfsWPXg3ocxWrW64pXWticjB30/MF97lPTrK2O2PjmbxyGl7Gez18fI+351wvy9vYqoSa1tffNYzEAu3U66ADfn01tzamLV4KRtA9AlQSVdwLYCJgR3AqgKA1G4F6rqAiYESYECYCgKAQIs0CMBwCAQHAYEBwCAEwIDrAsEAgOBJF38oFsCJMCMB8sCmA1XcC9V1ARMCJMCJMCMDzPtJ2v4nXxY8OxDjBXaiurvqmIDPUre8wO9bJ8pdx4cc4uO24yuyPbvJvzm4bm0VC5Wvr73GLcgspDFgykn3fdPvb8dDXWRm09a046zy9ozPaD27HDuWilFtynTvNOT3dVZJAZgOrEkHS9PDe/DeGn0/mc56Dms/j/aXFpGZfXSKDylkNNZ5Ax6c6qedd9B49N9Zurj09p4Y6juOxPaZOJY/ehe7sR+6ur3zBX0CCp81IOx9R5StmxTjtsOW7FdtM3L4lZiXGnuVGSRyVcj/o3AXrub82ClMcWjryHb9o8x6MPNvr13lONdcnMOZedKyw2PMbEq46xa8RPqOZ9mPajK4guYcnuiampCd3X3f3g+99T+ETfqcNce3CMHgPtBvt4ocPKpTGqY2Yy19WsTJDe7zufHeiOgA95fGZ301YxcVZ3/YZPtE7dW4F+Nj4qpZZrvb0dS20bolY11DHqenovjuY6fTxkrNrDYdtu0OXicOpykRKch3oWyp/06186sWTfTZBA6zDDirfJwz0Gb2C4xdmYFOTkcneu9wPIvIultZRob9AJjnpFLzWBrPaV2tbApRKCv2u5ga+Yc4SpSOZ2Xz390fM+kz02HzJ59B0PZnjdWdi1ZNXQONOm9mu0feQ/I/mCD5zTkxzjtNZG1mAIE0XfygWQIkwFAmBqAbgUKu4F6rqAiYESYESYEYCgeKdsKe87Rd33r0c1mKpurcVvVulPfVj4Ees6WGdtPvtuguwuW2Jxh8TGavMpttepsgVqbDUFLGwWDqADrfXlOviJOevHh4p5JUe0hGo4yL7lZq2bEyV6bD1V8gdB5E7Rhr4j1k6aYnDtHtHa9vu1uA/DchKsmm+zJrFddddiu/vEbZlHVdDZ666jXjK2DDeMkbx0GL7E+HWJjZOQ4ITItQVb/WWsMC4+BLEf2ZOttE2iI7DkewvE6MXi+RdkWLVX/nic7b1zG0aHT5GWc9ZthiKx6Iepcf4jTk8J4jdj2LbU2HlgOu9ErW4I6/EGUMdZrlrFo7wlyPsL+5xH+vjf8tksa3rUV+2Hs6UavilAKsGrTIKdCrAjur/AJ7AUn+p8ZOjy/7c/AY3s44RZxLOu4tmAMqW867XS2ZQA5dD8NahdfHl9DMtReMdIx1/sDpfbL/q0f8AFU/weaNH+IJezPKrp4LVdawSqr7XY7HwVVvsJMamszm2j2DzUcdTL4jZnZmNdlVEOiY9Q5uVOUrWhPoAzN/W6y55fBj4KztIy/Z32jbhuYab+8rxcghHFylGrbwrvI8vRj4aO/1ZGoxeZTeOsD3icoSRd/KBZuBHcAgTA1AixgR3AsVdQETAiTAiTAjAUAgczxnsPw3KvfIyKWstfl5j9ouRTyqFHuqwHgBN9NRkpHDWRsuEcCxMQEYtFVPNoMyL77AeHM56n6ma75LX+9IlxnguNmV91lUpcoO15thkbWtqw6qfkYpktSd6yNBi+zXhKMH+ztZo7C2322J9V3o/Xc2zqss9x11VYUKqgKqgBVUBVUDwAA8BK45S/wBm3CXZmah+ZmZ2IysgbYnZP3vWWI1WWOW/6DcYXZ3FpxHwERhiutqMhsdmK2k845983XmPnNc5bTfjnqFwDs3iYAtGJWaxaVL7tss2V3r7xOvExky2yfeGxzMVLq7KbVD12I1bqfBlYaImETMTvAp4Rw2rEopxqF5aql5VHiSfEsx82JJJPqTJveb2m0injfBsfNq7nJQ2Vc62cod6/eG9HakHzMml7Uneojg9n8SnG+xJSrYp5902E3KeZix3z737x38ItktNuKZ5iXAeBY2DW9WKndo9jXMOZnJdgB4nroAAD5RfJa872FXE+y+FlZFWVkUJbbUndrz9UK72OdfBtHet+HMZNct614YnkNyi/lNYs3AUBQJjpAizQIEwFuBcTAiTAgTAUBQCAiYEIDgECQEAgOAQCAQIwHqA4BAkogTgIwCBIdIESYESYEYBAsJgRJgKAoBARMCMAgOA4BAcAgEAgRgSgEAgNRAnANwFAfhARMCJMBQCAQJGAoCgEBEwIwCA4DgEBwCAQCAoBAcAgMCBLcBQCA9wETARMBQCAQCA4CgEBEwIwHANQHAIDgEAgEBQCA4BAYEBwCAQCAtwFAIBAIBAIAYBAIEYCgMQHAIDEAgEAgBgAgEAgECUAgEBQCAoBAIBAIBAIH//2Q==";
  </script>
  

  <!--ESTE ES EL DOCUMENTO DEL BODYLOGIN -->
  <script>
    $(document).ready(function() {
      // Initialise Sweet Alert library
      alerts.showSwal();
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
            
      $('#tablePaginator').DataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            "ordering": false
        } );
    } );
  </script>
</body>
</html>