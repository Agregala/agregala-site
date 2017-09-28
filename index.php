<?php get_header(); ?>		
<div class="container sin-padding">
	<div id="container-noticias" class="col-xs-12">
        <!-- add visualizar -->
        <div class="content-visualizar">
            <?php
                /** Grab any posts for this month (I've chosedn only the last 5 posts) */
                $args = array(
                    'posts_per_page'    => -1,
                    'post_type'         => 'post',
                    'post_status'       => 'publish',
                    'order_by'          => 'date'
                );
                $month_query = new WP_Query($args);

                if($month_query->have_posts()) :
                    /** Loop through each post for this month... */
                    $contador = 0;
                    while($month_query->have_posts()) : $month_query->the_post();
                        $link =  get_permalink(get_the_ID());

                        $thumbID = get_post_thumbnail_id( get_the_ID() );
                        $imgDestacada = wp_get_attachment_url( $thumbID );

                        $posttags = get_the_tags();
                        if ($posttags) {
                          foreach($posttags as $tag) {
                            if($tag->name=="Page"){
                                $varSapn = "faceFondo";
                            }else{
                                $varSapn = "rssFondo";
                            }
                          }
                        }
                        if( $imgDestacada != "" ){
                            $contador = $contador+1;
                            $arryaNotin[] = get_the_ID();
                            if($contador<5){
                                echo '<div class="col-md-3 col-sm-6">';
                                    echo '<div class="content-noticias new-style-content" data-link="'.get_post_permalink().'" ">';
                                        /** Output each article for this month */
                                        echo '<div class="back-img-noti" style="background-image: url('.$imgDestacada.');"></div>';
                                        //echo '<img style="margin-bottom: 10px; width: 100%;" src="'.$imgDestacada.'" />';
                                        echo '<h3 class="titulo-note-visualizar">'.get_the_title().'</h3>'; 	
                                        echo '<a class="read-more floats" target="_blank" href="'.get_post_permalink().'">'.get_option('fullby_leermas').'</a>';
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
			<h2><?php echo get_option('fullby_twitter'); ?></h2>
			<p>
				<?php
					obtenerTweets();
				?>
			</p>
		</div>
	</div>
</div>	
<?php get_footer(); ?>	