<?php get_header(); ?>
    <style>
        p > em > img,
        p > img,
        img[Attributes Style],
        img {
            width: 100% !important;
        }
    </style>
	<div class="container sin-padding">	
		<div id="container-single" class="col-md-12 sin-padding">
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			<h2 class="titulo-page"><?php echo get_the_title();?></h2>
			<span class="barra-azul"></span>
            <div class='col-sm-8 contenido-page'>
                <p><?php the_content(); ?></p>
            </div>
             <div class='col-sm-4 '></div>
            <div class="clearfix"></div>
            <?php 
                	if(is_page('Medios')){
            ?>
                	<div class="clearfix"></div><br>
                	<div class="col-xs-12">
                		<!-- CATEGORIES-->
                        <?php 
                        $categories = get_categories( array(
                            'orderby' => 'name',
                            'parent'  => 0
                        ) );
                        $url_sites = get_site_url();
                        $contador = 0;
                        foreach ( $categories as $category ) {
                            $contador = $contador+1; 
                            $saved_data = get_tax_meta($category->term_id,'ba_url_coletivo');
                            $url_logos = get_tax_meta($category->term_id,'ba_url_logo_coletivo');
                        ?>
                        <div id="medio-contenet" class="col-md-6">
							<?php 
                                echo "<span class='icon-colectivo' style='right: 0px;top: 0px;position: absolute;background: url(".$url_logos.");background-size: 100%;'></span>";
                            ?>
                			<p class="titulo-note"><?php echo $category->name; ?></p>
                			<p class="lugar-fecha" style="padding-left: 46px;"></p>
                			<div class="col-xs-12 sin-padding">
                                <div class="col-xs-12">
                                    <br>
                                    <p style="margin-left: -13px;font-size: 12px;font-family: 'montserratregular' !important;margin-top: 50px;"><?php echo $category->description; ?></p>
                                    <br>
                                </div>
                                <div class="clearfix"></div>
                				<div class="col-xs-6">
                					<a class="linked" href="<?php echo $saved_data ; ?>" target="_blank"><?php echo get_option('fullby_sitio'); ?></a>
                				</div>
                				<div class="col-xs-6">
                					<a class="linked" href="<?php echo $url_sites."/category/".$category->slug; ?>" ><?php echo get_option('fullby_publicacoes'); ?></a>
                				</div>
                			</div>
                		</div>
                        <?php 
                            if( (( $contador % 3 ) == 0) ){
                                echo '<div class="clearfix"></div>';
                            }
                        } ?>
                        <!-- END CATEGORIES-->
                	</div>
                <?php } ?>
            <?php endwhile; endif; ?>
		</div>
	</div>	
<?php get_footer(); ?>