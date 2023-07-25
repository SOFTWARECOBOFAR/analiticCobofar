<?php
$globalNameUserX=$_SESSION['globalNameUser'];
$globalNombreUnidadX=$_SESSION['globalNombreUnidad'];
$globalNombreAreaX=$_SESSION['globalNombreArea'];

?>

<section class="after-loop">
  <div class="container">
    <div class="div-center text-center"> 
     <br><br>
      <div class="row">
        <!-- testimonial -->
        <div class="col-md-10">
          <div class="dark_bg full margin_bottom_30">
            <div class="full graph_head">
              <div class="heading1 margin_0">
                <h2>COBOFAR</h2>
              </div>
            </div>
            <div class="full graph_revenue">
               <div class="row">
                  <div class="col-md-12">
                     <div class="content testimonial">
                        <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                           <!-- Wrapper for carousel items -->
                           <div class="carousel-inner">
                              <div class="item carousel-item active">
                                 <div class="img-box"><img src="assets/img/default-avatar.png" alt=""></div>
                                 <p class="testimonial">Bienvenidos a Analytics de FARMACIAS BOLIVIA!.</p>
                                 <p class="overview"><b><?=$globalNameUserX;?></b><?=$globalNombreAreaX;?></p>
                              </div>
                              <div class="item carousel-item">
                                 <div class="img-box"><img src="assets/img/default-avatar.png" alt=""></div>
                                 <p class="testimonial">Bienvenidos a Analytics de FARMACIAS BOLIVIA!.</p>
                                 <p class="overview"><b><?=$globalNameUserX;?></b><?=$globalNombreAreaX;?></p>
                              </div>
                              
                           </div>
                           <!-- Carousel controls -->
                           <a class="carousel-control left carousel-control-prev" href="#testimonial_slider" data-slide="prev">
                           <i class="fa fa-angle-left"></i>
                           </a>
                           <a class="carousel-control right carousel-control-next" href="#testimonial_slider" data-slide="next">
                           <i class="fa fa-angle-right"></i>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          </div>
        </div>
        <!-- end testimonial -->
      </div>
    </div>
  </div>
</section>


