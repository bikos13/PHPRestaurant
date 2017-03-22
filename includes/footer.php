<!-- This first </div> closes the container opened in the end of header.php section - Constantine -->
</div>

<!-- Start of footer section - Constantine -->

<footer>

    <div class="container">
        
        <!--Start of Footer Row containing 3 columns - Constantine -->
        
        <div class="row">
            
            <!-- 1 of 3 columns providing contact details - Constantine -->
            
            <div class="col-md-4 text-center">
                <h2 class="intro-text">Where to find us?</h2>
                <iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59304.50856869819!2d21.817799560433716!3d38.63026810644767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135efe799bedbba3%3A0xae2e8bbef18bcd60!2zzpXPgM6xz4Euzp_OtC4gzp3Osc-Fz4DOrM66z4TOv8-FIC0gzqDOu86xz4TOrM69zr_PhSAtIM6ozrfOu86_z40gzqPPhM6xz4XPgc6_z40sIM6dzrHPhc-AzrHOus-Ezq_OsSAzMDAgMjI!5e0!3m2!1sel!2sgr!4v1482850377816"></iframe>
                <h4>LIKOFOTOS 3 & AETOFOLIAS | ANO KATAGOGIA | <a href="tel:00302613055055">+30 26130 55055</a></h4>
            </div>
            
            <!-- 2 of 3 columns providing Store Hours using the appropriate function (study below for further information - Constantine -->
            
            <div class="col-md-4 text-center">
                
                <!--Including php storehours full table - Constantine -->
                <h2 class="intro-text">Open Hours</h2>
                
                <?php
                //Calling phpstorehours.php a plugin developed by Cory Etzkorn (More in the Report) - Constantine
                include_once('includes/phpstorehours.php');
                echo '<table class="table table-striped" style="margin:0;">';
                foreach ($store_hours->hours_this_week() as $days => $hours) {
                    echo '<tr>';
                    echo '<td>' . $days . '</td>';
                    echo '<td>' . $hours . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                
                //Calling php store hours message for being open or closed - Constantine
                echo '<p style="padding: 0;">';
                $store_hours->render();
                echo '</p>';
                ?>
            </div>
            
            <!-- 3 of 3 columns showing a fun cover of the song's Every Step you take lyrics - Constantine -->
            
            <div class="col-md-4 text-center" style="vertical-align: middle;">
                <div class="box" style="margin: 10%;">
                    <blockquote aria-label="testimonial comment">Every sniff you take<br>
                        Every food you make<br>
                        Every pizza you baked<br>
                        Every burger you ate<br>
                        We will always be cooking better than<br>
                        <strong>YOU!</strong></blockquote>
                    <cite aria-label="author of testimonial">- Felipe</cite>
                </div>
            </div>
            
            
        </div>
        
        <!-- ! End of Footer Row - Constantine-->
        
    </div>

    <!-- Subfooter Start - Constantine -->
    
    <div class="container-fluid" style='border-top:solid 2px rgba(0,0,0, 0.2)'>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p style="margin: 0; padding: 0">Copyright &copy; Felipetakia 2016 - <?php echo date('Y'); ?> | Designed by: Constantine</p>
            </div>
        </div>
    </div>
    
    <!-- ! Subfooter End - Constantine -->
    
</footer>
<!-- ! End of Footer section - Constantine -->

