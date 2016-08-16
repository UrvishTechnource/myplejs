<?php
/*
Template Name: Min sida
*/
get_header(); ?>
<div id="content" class="container">
    <div class="row">
        <div class="col-xs-12">
            <!-- breadcrumb -->
            <div class="breadcrumbs">
                <span class="spanleft">
                    <?php if(function_exists('bcn_display'))
                    {
                    bcn_display();
                    }?>
                </span>
                <span class="tillbaka"><a href="javascript:history.back();"><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Back</a><?php else: ?>Tillbaka</a><?php endif; ?></span>
            </div>
            <!-- end breadcrumb -->
        </div>
    </div>
    <div class="row">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!-- content -->
        <article id="post-<?php the_ID(); ?>">
            <h1 class="page-title col-xs-12" itemprop="headline">
            <?php if(get_field('alt_title')): the_field('alt_title'); else : ?>
            <?php the_title(); ?>
            <?php endif; ?>
            </h1>
            <section class="post-content col-xs-12 col-sm-7">
                <?php the_content(); ?>
            </section>
            <?php endwhile;  endif; ?>
            <!-- user info block -->
            <section class="col-xs-12 col-sm-5">
                <?php if ( is_user_logged_in() ): ?>
                
                <div id="userinfo">
                    <?php global $current_user; get_currentuserinfo(); ?>
                    <?php echo '<span style="font-size: 17px; color: #000;display:block;">' . $current_user->user_firstname . "&nbsp;";
                    echo '' . $current_user->user_lastname . "</span>";
                    echo '<span style="font-size: 15px; color: #666; line-height: 18px;display:block;margin-bottom:15px;">' . $current_user->user_email . "</span>";
                    ?>
                    <div style="width:100%;margin-bottom:10px;" class="clearfix">
                    <div class="btn-small-green" >
                    <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                        <a href="http://myplejs.se/en/my-page/edit-profile/">Edit account</a>
                        <i class="fa fa-pencil-square-o"></i>
                    <?php else: ?>
                        <a href="<?php bloginfo('url'); ?>/?page_id=283">Redigera kontouppgifter</a>
                        <i class="fa fa-pencil-square-o"></i>
                    <?php endif; ?>
                        </div>
                    </div>
            
                    <?php
                    
                    $userid = get_current_user_id();
                    
                    $args = array(
                    'post_type' => 'app',
                    'author' => $userid,
                    'posts_per_page' => 1,
                    'post_status' => array('publish', 'pending','draft')
                    );
                    query_posts( $args );?>
                    
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    
                    <?php $postid = get_the_ID(); ?>
                    
                    <div class="btn-small-green" >
                        <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                            <a href="<?php bloginfo('url'); ?>/?page_id=160988&gform_post_id=<?php echo $postid; ?>">Edit/update application<i class="fa fa-eye"></i></a>
                        <?php else: ?>
                            <a href="<?php bloginfo('url'); ?>/?page_id=701&gform_post_id=<?php echo $postid; ?>">Visa/uppdatera ansökan<i class="fa fa-eye"></i></a>
                        <?php endif; ?>

                        

                    </div>
                    
                    <?php endwhile;?>
                    <?php else: ?>
                    <div class="btn-small-green">
                    
                    <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                        <a href="http://myplejs.se/en/add-application/" >I want to rent</a>
                    <?php else: ?>
                        <a href="/lagg-till-ansokan/" >Jag vill hyra</a>
                    <?php endif; ?>
                        

                    </div>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>
                    
                    
                </div>
            </section>
            <!-- user info block /end -->
        </div>
        <?php endif; ?>
        
        
        
        <!-- user objects -->
        <div class="row ">
            <?php if ( is_user_logged_in() ):
            
            $user_id = get_current_user_id();
            
            $args = array(
            'post_type' => 'objects',
            'author' => $current_user->ID,
            'posts_per_page' => -1,
            'post_status' => array('publish', 'pending','draft')
            );
            query_posts( $args );?>
            
            <!-- om uthyraren har objekt -->
            <section class="col-xs-12 minsidaobjekt">
                <h2 class="h2minsida"><span class="minaobjekt">&nbsp;</span><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>My objects</h2><?php else: ?>Mina objekt</h2><?php endif; ?>
                <ul>
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    
                    
                    
                    <li>
                        <div class="objlist list clearfix"><?php $postid = get_the_ID(); ?>
                            <div class="obj obj-minsida clearfix">
                                
                                <?php
                                if ( has_post_thumbnail() ) {
                                the_post_thumbnail('object-thumb-250');
                                }
                                else {
                                echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/default.png" />';
                                }
                                ?>
                                <div class="objinfo">
                                    <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                    <ul>
                                        <?php if (get_field('obj_rooms')): ?>
                                        <li class="antalrum"><span class="sort-room"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Rooms:<?php else: ?>Antal rum:<?php endif; ?></b> <?php the_field ('obj_rooms'); ?></span></li>
                                        <?php endif; ?>
                                        <?php if (get_field('obj_size')): ?>
                                        <li class="storlek"><span class="sort-size"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Size:</b> <?php the_field ('obj_size'); ?></span> sqm</li><?php else: ?>Storlek:</b> <?php the_field ('obj_size'); ?></span> kvm</li><?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (get_field('obj_rent')): ?>
                                        <li class="pris"><span class="sort-price"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Rent:</b> <?php the_field ('obj_rent'); ?></span> SEK</li><?php else: ?>Hyra:</b> <?php the_field ('obj_rent'); ?></span> SEK</li><?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (get_field('obj_move')): ?>
                                        
                                        <?php
                                        // generate timestamp from obj_move
                                        $date = get_field('obj_move');
                                        $timestamp = 0;
                                        if ( DateTime::createFromFormat('!d/m/Y', $date) ) {
                                        $timestamp = DateTime::createFromFormat('!d/m/Y', $date)->getTimestamp();
                                        }
                                        ?>
                                        <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                                        <li class="inflytt"><b>Moving in date:</b>
                                            <?php
                                            // print omgående or date
                                            $today = time();
                                            if ( $timestamp < $today ) {
                                            _e('Immediately', 'myplejs');
                                            } else {
                                            echo get_field('obj_move');
                                            }
                                            ?>
                                        </li>
                                        <?php else: ?>
                                        <li class="inflytt"><b>Inflytt:</b>
                                            <?php
                                            // print omgående or date
                                            $today = time();
                                            if ( $timestamp < $today ) {
                                            _e('Omgående', 'myplejs');
                                            } else {
                                            echo get_field('obj_move');
                                            }
                                            ?>
                                        </li>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (get_field('obj_contractlenght')): ?>
                                        <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                                        <li class="langd">
                                            <span class="sort-lenght"><b>Length of rental: </b><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Until further notice', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
                                            <?php if ($value_lenght == '1') { _e('month', 'myplejs'); }
                                            elseif ($value_lenght == '100') { }
                                            else { _e('months', 'myplejs'); } ?>
                                        </li>
                                        <?php else: ?>
                                        <li class="langd">
                                            <span class="sort-lenght"><b>Hyreslängd: </b><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Tillsvidare', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
                                            <?php if ($value_lenght == '1') { _e('månad', 'myplejs'); }
                                            elseif ($value_lenght == '100') { }
                                            else { _e('månader', 'myplejs'); } ?>
                                        </li>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </ul>
                                    <span>
                                        <?php $terms = get_the_terms($post->ID,'obj_city');
                                        $sep = '';
                                        $list = '';
                                        $find_parent = 0;
                                        for( $i = 0; $i < sizeof($terms); ++$i) {
                                        foreach ($terms as $term) {
                                        if ($term->parent == $find_parent) {
                                        $find_parent = $term->term_id;
                                        $list .= $sep .$term->name;
                                        $sep = ', ';
                                        }
                                        }
                                        }
                                        echo "$list"; ?>, <span class="no_translate"><?php the_field('obj_address'); ?></span>
                                    </span>
                                    
                                </div>
                                <!-- end objinfo -->
                                <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                                <?php
                                if(get_post_status() == 'pending') {
                                ?><div class="pending">Under Review</div><?php
                                }
                                elseif(get_post_status() == 'draft') {
                                ?><div class="pending">Not published</div><?php
                                }
                                else {
                                };
                                ?>
                                <!-- btns wrap -->
                                <div class="btns-wrap">
                                    <div class="btn-small">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Show</a>
                                    </div>
                                    <div class="btn-small">
                                        <a href="/?page_id=160987&gform_post_id=<?php echo $postid; ?>">Edit</a>
                                    </div>
                                </div>
                                <!-- end btns-wrap -->
                                <?php else: ?>
                                <?php
                                if(get_post_status() == 'pending') {
                                ?><div class="pending">Under granskning</div><?php
                                }
                                elseif(get_post_status() == 'draft') {
                                ?><div class="pending">Ej publicerad</div><?php
                                }
                                else {
                                };
                                ?>
                                <!-- btns wrap -->
                                <div class="btns-wrap">
                                    <div class="btn-small">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Visa</a>
                                        <i class="fa fa-chevron-circle-right"></i>
                                    </div>
                                    <div style="margin-left:7px;"class="btn-small">
                                        <a href="/?page_id=371&gform_post_id=<?php echo $postid; ?>">Ändra</a>
                                        <i class="fa fa-pencil-square-o"></i>
                                    </div>
                                </div>
                                <!-- end btns-wrap -->
                                <?php endif; ?>
                                
                            </div>
                            <!-- end obj -->
                        </div>
                    </li>
                    <?php endwhile;?>
                    <?php else: ?>
                    <li class="objlist-last-minsida">&nbsp;</li>
                    
                    <?php endif; ?><?php wp_reset_query(); ?><?php endif; ?>
                    <div class="btn-small-green addObject" >
                        <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                            <a href="http://myplejs.se/en/my-page/add-object/">Add object</a>
                        <?php else: ?>
                            <a href="/lagg-till-objekt/">Lägg till uthyrningsobjekt</a>
                        <?php endif; ?>
                        <i class="fa fa-plus-square"></i>
                    </div>
                </ul>
            </section>
        </div>
        <!-- user objects /end -->
        
        
        <!-- Mina intressen -->
        
        <?php if ( is_user_logged_in() ) : ?>
        
        
        <?php
        
        // get the current logged in user
        $userid = get_current_user_id();
        
        // loop registration
        $args = array(
        'post_type' => 'registration',
        'posts_per_page' => -1,
        'post_status' => array('publish', 'pending'),
        'meta_query' => array(
        array(
        'key' => 'reg_user_id',
        'value' => $userid,
        'compare' => '=',
        'type' => 'NUMERIC'
        ),
        array(
        'key' => 'reg_status',
        'value' => 'Intresserad',
        'compare' => '=',
        'type' => 'CHAR'
        )
        )
        );
        
        query_posts( $args );?>
        
        <?php if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        $data = get_field('reg_obj_id');
        $regids[]=$data;
        endwhile; endif;
        
        //if regids is empty do nothing
        if( empty($regids) ) {
        }
        //else show the second loop
        else {
        $args = array(
        'post_type' => 'objects',
        'posts_per_page' => -1,
        'post__in' => $regids,
        'post_status' => 'publish',
        );
        query_posts($args);
        ?><?php if ( have_posts() ) : ?>
        <h2 class="h2minsida"><span class="minaintresseanmalningar">&nbsp;</span><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>My interest notifications</h2><?php else: ?>Mina intresseanmälningar</h2><?php endif; ?>
        <ul class="clearfix"><?php while ( have_posts() ) : the_post(); ?>
            
            <li class="clearfix"><div class="objlist list"><?php $postid = get_the_ID(); ?>
                <div class="obj obj-minsida clearfix">
                    
                    <?php
                    if ( has_post_thumbnail() ) {
                    the_post_thumbnail('object-thumb-250');
                    }
                    else {
                    echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/default.png" />';
                    }
                    ?>
                    <div class="objinfo">
                        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <ul>
                            <?php if (get_field('obj_rooms')): ?>
                            <li class="antalrum"><span class="sort-room"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Rooms:<?php else: ?>Antal rum:<?php endif; ?></b> <?php the_field ('obj_rooms'); ?></span></li>
                            <?php endif; ?>
                            <?php if (get_field('obj_size')): ?>
                            <li class="storlek"><span class="sort-size"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Size:</b> <?php the_field ('obj_size'); ?></span> sqm</li><?php else: ?>Storlek:</b> <?php the_field ('obj_size'); ?></span> kvm</li><?php endif; ?>
                            <?php endif; ?>
                            <?php if (get_field('obj_rent')): ?>
                            <li class="pris"><span class="sort-price"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Rent:</b> <?php the_field ('obj_rent'); ?></span> SEK</li><?php else: ?>Hyra:</b> <?php the_field ('obj_rent'); ?></span> SEK</li><?php endif; ?>
                            <?php endif; ?>
                            <?php if (get_field('obj_move')): ?>
                            
                            <?php
                            // generate timestamp from obj_move
                            $date = get_field('obj_move');
                            $timestamp = 0;
                            if ( DateTime::createFromFormat('!d/m/Y', $date) ) {
                            $timestamp = DateTime::createFromFormat('!d/m/Y', $date)->getTimestamp();
                            }
                            ?>
                            <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                            <li class="inflytt"><b>Moving in date:</b>
                                <?php
                                // print omgående or date
                                $today = time();
                                if ( $timestamp < $today ) {
                                _e('Immediately', 'myplejs');
                                } else {
                                echo get_field('obj_move');
                                }
                                ?>
                            </li>
                            <?php else: ?>
                            <li class="inflytt"><b>Inflytt:</b>
                                <?php
                                // print omgående or date
                                $today = time();
                                if ( $timestamp < $today ) {
                                _e('Omgående', 'myplejs');
                                } else {
                                echo get_field('obj_move');
                                }
                                ?>
                            </li>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php if (get_field('obj_contractlenght')): ?>
                            <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                            <li class="langd">
                                <span class="sort-lenght"><b>Length of rental: </b><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Until further notice', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
                                <?php if ($value_lenght == '1') { _e('month', 'myplejs'); }
                                elseif ($value_lenght == '100') { }
                                else { _e('months', 'myplejs'); } ?>
                            </li>
                            <?php else: ?>
                            <li class="langd">
                                <span class="sort-lenght"><b>Hyreslängd: </b><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Tillsvidare', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
                                <?php if ($value_lenght == '1') { _e('månad', 'myplejs'); }
                                elseif ($value_lenght == '100') { }
                                else { _e('månader', 'myplejs'); } ?>
                            </li>
                            <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                        <span>
                            
                            
                            <?php $terms = get_the_terms($post->ID,'obj_city');
                            $sep = '';
                            $list = '';
                            $find_parent = 0;
                            for( $i = 0; $i < sizeof($terms); ++$i) {
                            foreach ($terms as $term) {
                            if ($term->parent == $find_parent) {
                            $find_parent = $term->term_id;
                            $list .= $sep .$term->name;
                            $sep = ', ';
                            }
                            }
                            }
                            echo "$list"; ?>, <span class="no_translate"><?php the_field('obj_address'); ?></span>
                        </span>
                        
                        </div> <!-- end objinfo -->
                        
                        <?php echo $my_intresse_button->intresse_button(); ?>
                        <?php
                        if(get_post_status() == 'pending') {
                        ?><div class="pending">Ej publicerad</div><?php
                        } else {
                        
                        };
                        ?>
                        <div class="btns-wrap">
                            <div class="btn-small"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Show</a><i class="fa fa-chevron-circle-right"></i></div><?php else: ?>Visa</a><i class="fa fa-chevron-circle-right"></i></div><?php endif; ?>
                            </div> <!-- end btns-wrap -->
                            </div> <!-- end obj -->
                        </div></li>
                        
                        <?php endwhile;?>
                        
                        <li class="objlist-last-minsida">&nbsp;</li>
                        
                        <?php endif; wp_reset_query(); ?>
                        
                        <?php } endif; ?>
                        
                    </ul>
                    
                    <!-- Mina intressen /end -->
                    
                    
                    
                    
                    <!-- Mina bokmärken -->
                    
                    <?php if ( is_user_logged_in() ) : ?>
                    
                    <?php
                    $args = array(
                    'post_type' => 'objects',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'meta_key' => 'user_bookmark',
                    'meta_value' => $user_id
                    );
                    query_posts($args);
                    ?><?php if ( have_posts() ) : ?>
                    <h2 class="h2minsida"><span class="minabokmarken">&nbsp;</span><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>My Bookmarks</h2><?php else: ?>Mina Bokmärken</h2><?php endif; ?>
                    <ul><?php while ( have_posts() ) : the_post(); ?>
                        
                        <li><div class="objlist list"><?php $postid = get_the_ID(); ?>
                            <div class="obj obj-minsida clearfix">
                                
                                <?php
                                if ( has_post_thumbnail() ) {
                                the_post_thumbnail('object-thumb-250');
                                }
                                else {
                                echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/default.png" />';
                                }
                                ?>
                                <div class="objinfo">
                                    <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                    <ul>
                                        <?php if (get_field('obj_rooms')): ?>
                                        <li class="antalrum"><span class="sort-room"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Rooms:<?php else: ?>Antal rum:<?php endif; ?></b> <?php the_field ('obj_rooms'); ?></span></li>
                                        <?php endif; ?>
                                        <?php if (get_field('obj_size')): ?>
                                        <li class="storlek"><span class="sort-size"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Size:</b> <?php the_field ('obj_size'); ?></span> sqm</li><?php else: ?>Storlek:</b> <?php the_field ('obj_size'); ?></span> kvm</li><?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (get_field('obj_rent')): ?>
                                        <li class="pris"><span class="sort-price"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Rent:</b> <?php the_field ('obj_rent'); ?></span> SEK</li><?php else: ?>Hyra:</b> <?php the_field ('obj_rent'); ?></span> SEK</li><?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (get_field('obj_move')): ?>
                                        
                                        <?php
                                        // generate timestamp from obj_move
                                        $date = get_field('obj_move');
                                        $timestamp = 0;
                                        if ( DateTime::createFromFormat('!d/m/Y', $date) ) {
                                        $timestamp = DateTime::createFromFormat('!d/m/Y', $date)->getTimestamp();
                                        }
                                        ?>
                                        <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                                        <li class="inflytt"><b>Moving in date:</b>
                                            <?php
                                            // print omgående or date
                                            $today = time();
                                            if ( $timestamp < $today ) {
                                            _e('Immediately', 'myplejs');
                                            } else {
                                            echo get_field('obj_move');
                                            }
                                            ?>
                                        </li>
                                        <?php else: ?>
                                        <li class="inflytt"><b>Inflytt:</b>
                                            <?php
                                            // print omgående or date
                                            $today = time();
                                            if ( $timestamp < $today ) {
                                            _e('Omgående', 'myplejs');
                                            } else {
                                            echo get_field('obj_move');
                                            }
                                            ?>
                                        </li>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (get_field('obj_contractlenght')): ?>
                                        <?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
                                        <li class="langd">
                                            <span class="sort-lenght"><b>Length of rental: </b><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Until further notice', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
                                            <?php if ($value_lenght == '1') { _e('month', 'myplejs'); }
                                            elseif ($value_lenght == '100') { }
                                            else { _e('months', 'myplejs'); } ?>
                                        </li>
                                        <?php else: ?>
                                        <li class="langd">
                                            <span class="sort-lenght"><b>Hyreslängd: </b><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Tillsvidare', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
                                            <?php if ($value_lenght == '1') { _e('månad', 'myplejs'); }
                                            elseif ($value_lenght == '100') { }
                                            else { _e('månader', 'myplejs'); } ?>
                                        </li>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </ul>
                                    <span>
                                        
                                        
                                        <?php $terms = get_the_terms($post->ID,'obj_city');
                                        $sep = '';
                                        $list = '';
                                        $find_parent = 0;
                                        for( $i = 0; $i < sizeof($terms); ++$i) {
                                        foreach ($terms as $term) {
                                        if ($term->parent == $find_parent) {
                                        $find_parent = $term->term_id;
                                        $list .= $sep .$term->name;
                                        $sep = ', ';
                                        }
                                        }
                                        }
                                        echo "$list"; ?>, <span class="no_translate"><?php the_field('obj_address'); ?></span>
                                    </span>
                                    
                                    </div> <!-- end objinfo -->
                                    
                                    <?php echo $delete_bookmark_button->delete_bookmark_button(); ?>
                                    <?php
                                    if(get_post_status() == 'pending') {
                                    ?><div class="pending">Ej publicerad</div><?php
                                    } else {
                                    
                                    };
                                    ?>
                                    <div class="btns-wrap">
                                        <div class="btn-small"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Show</a><i class="fa fa-chevron-circle-right"></i></div><?php else: ?>Visa</a><i class="fa fa-chevron-circle-right"></i></div><?php endif; ?>
                                        </div> <!-- end btns-wrap -->
                                        </div> <!-- end obj -->
                                    </div></li>
                                    <?php endwhile;?><li class="objlist-last-minsida">&nbsp;</li><?php endif; ?><?php wp_reset_query(); ?><?php endif; ?></ul>
                                    
                                    <!-- Mina bokmärken /end -->
                                </section>
                                <!-- end user block -->
                                </article> <!-- end article -->
                                <!-- end content -->
                            </div>
                        </div>
                        <?php
                        // ------------------------- execute function (defined in functions.php) -------------------------
                        change_date_format_for_object('obj_move');
                        ?>
                        	<?php get_footer(); ?>

	<script src="<?php echo get_stylesheet_directory_uri() ?>/dev_packs/mixpanel.js"></script>

<script type="text/javascript">
function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
}

utm_source = getURLParameter('utm_source');
// create cookie if utm_source is set in the url
if (utm_source) {
    var newDate = new Date(new Date().getTime() + 30*24*60*60*1000);
    document.cookie = 'utmsourcetoken=utm_source:' + utm_source + '; expires=' + newDate + '; path=/';
}

// track Visit event in mixpanel
mixpanel.init("6bb01f7cb7489082e6b49e891ba9a115", {
    loaded: function() {
    	mixpanel.track("Visit");
    }
});

</script>