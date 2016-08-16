						<section class="post-content clearfix" id="faq">
							
								<a class="faq-show-all">Visa samtliga svar</a>
							
							    <h2><?php _e('Frågor & Svar','myplejs'); ?></h2>
							    
							    <?php if(get_field('faq')): ?>
 								 
									<?php while(has_sub_field('faq')): ?>
									
										<div class="faq">

											<a class="faq-show-next"><?php the_sub_field('faq_question'); ?></a>
											
											<a class="faq-show faq-link"></a>
											
											<div class="faq-a toggle">
												<?php the_sub_field('faq_answer'); ?>
											</div>
											
										</div>
								 
									<?php endwhile; ?>
								 								 
								<?php endif; ?>
								
							</section> <!-- end article section -->