<?php get_header(); ?>		
<div class="container sin-padding">
	<div id="container-noticias" class="col-xs-12">
        <!-- add visualizar -->
        <div class="content-visualizar">
            <?php
                wp_reset_query();
                /** Grab any posts for this month (I've chosedn only the last 5 posts) */
                $args1 = array(
                    'posts_per_page'    => -1,
                    'post_type'         => 'post',
                    'post_status'       => 'publish',
                    'order_by'          => 'date'
                );
                $month_query1 = new WP_Query($args1);
                $arryaNotin = array();
                if($month_query1->have_posts()) :
                    /** Loop through each post for this month... */
                    $contador1 = 0;
                    while($month_query1->have_posts()) : $month_query1->the_post();
            
                        $thumbID1 = get_post_thumbnail_id( get_the_ID() );
                        $imgDestacada1 = wp_get_attachment_url( $thumbID1 );

                        if( $imgDestacada1 != "" ){
                            $contador1 = $contador1+1;
                            $arryaNotin[] = get_the_ID();
                            if($contador1<5){
                                echo '<div class="col-md-3 col-sm-6">';
                                    echo '<div class="content-noticias new-style-content" data-link="'.get_permalink(get_the_ID()).'" ">';
                                        /** Output each article for this month */
                                        echo '<div class="back-img-noti" style="background-image: url('.$imgDestacada1.');"></div>';
                                        //echo '<img style="margin-bottom: 10px; width: 100%;" src="'.$imgDestacada.'" />';
                                        echo '<h3 class="titulo-note-visualizar">'.get_the_title().'</h3>'; 	
                                        echo '<a class="read-more floats" target="_blank" href="'.get_permalink(get_the_ID()).'">'.get_option('fullby_leermas').'</a>';
                                    echo '</div>';
                                echo '</div>';
                            }else{
                                break;
                            }
                        }
                    endwhile;
                    /** FINALIZA LOOP DE NOTICIAS **/
                endif;
                //print_r($arryaNotin);
                /** Reset the query so that WP doesn't do funky stuff */
                wp_reset_query();
            ?>
        </div>
        <div class="clearfix"></div>
        <!-- end visualizar -->
		<!-- content facebook -->
		<div class="col-md-8 sin-padding">
			<div class="col-sm-3 sin-padding">
				<ul class="nav nav-tabs tabs-left">
	                <li class="active medios"><?php echo get_option('fullby_medios'); ?>:</li>
	                <?php obtenerListCategories();?>
	                <?php get_sidebar('secondary'); ?>
	            </ul>
	            
			</div>
			<div class="col-sm-9">
				<div id="content" class="tab-content">
                	<div class="tab-pane active" id="<?php echo idAhora(); ?>">
                		<?php
                            //print_r($arryaNotin);
                            if(count($arryaNotin)<0){
                                $arryaNotin = array();
                            }
                			postsPorFecha(date(Y),date(M),$arryaNotin);
                		?>
                	</div>
	            </div>
			</div>
            <div class="clearfix"></div>
            <center>
                <div class="nav-previous alignleft"><?php next_posts_link( '<< Noticias anteriores' ); ?></div>
                <div class="nav-next alignright"><?php previous_posts_link( 'Noticias nuevas >>' ); ?></div>
            </center>
		</div>
		<!-- content twitter -->
        <div class="clearfix hidden-lg hidden-md visible-sm visible-xs"></div>
		<div id="container-tweets" class="col-md-4">
			<h2>Otras voces</h2>
			<p>
				<?php
					//obtenerTweets();
				?>
			</p>
		</div>
	</div>
</div>	
<?php get_footer(); ?>	