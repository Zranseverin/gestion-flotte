<?php

error_reporting(0);

include('includes/dbconnection.php');
?>
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            
                            <div class="user-section-inner">
                                <img src="../assets/img/logo.png" alt="">
                            </div>
                            <div class="user-info">
                                <?php
$aid=$_SESSION['bpmsaid'];
$sql="SELECT AdminName from  tbladmin where ID=:aid";
$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                <div><strong><?php  echo $row->AdminName;?></strong></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                            <?php $cnt=$cnt+1;}} ?>
                        </div>
                        
                        <!--end user image section-->
                    </li>

                    <li class="selected">
                        <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
                   
                   
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Enregistrements <span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-ch.php">chauffeur</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-cont.php">contrat</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-vh.php">vehicules</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-pro.php">Proprietaire</a>
                            </li>
                           
                        </ul>
                       
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="attr-vh.php">Attribution</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-attr.php">Attribution</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-vsmt.php">versement</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-vr.php">versements</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-km.php">suivi véhicule</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-dp.php">depenses</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-p.php">Pannes</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-p.php">Pannes &facture</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-reparation.php">reparation de la pannes1</a>
                            </li>
                            <li>
                                <a href="add-declaration.php">declaration</a>
                            </li>
                            <ul class="nav nav-second-level">
                        <li>
                                <a href="add-d-pannes.php">reparation de la pannes</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="add-sni.php">snistre</a>
                            </li>
                           
                        </ul>
                        <!-- second-level-items -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Registres <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-ch.php">liste chauffeurs</a>
                            </li>
                           
                            <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-cont.php">contrat</a>
                            </li>
                           
                        </ul>
                        
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-vh.php">liste vehicules</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-pro.php">liste des proprietaires</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-attr.php">liste  Attributions</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="manage-vst.php">liste recette</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="manage-depenses.php">dépenses</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="manage-decl.php">liste des declaration</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="manage-repar.php">liste des diagnotisque</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="detail-r.php">detail recette</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="detail-c.php">detail chauffeur</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="recher-ch.php">recherche chauffeurs</a>
                                
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                        
                                <a href="recher-vh.php">recherche vehicules</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-svi.php">liste  des suivis</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="detail-svi.php">detail des suivis</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-dp.php">list depense</a>
                            </li>
                           
                        </ul>
                          <!-- #region -->
                          <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-p.php">list des Pannes</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-decl.php">list des Pannes</a>
                            </li>
                           
                        </ul>

                       
                        <ul class="nav nav-second-level">
                        
                           
                        </ul>
                        <!-- second-level-items -->
                    </li>
                    
                   
                   
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Parametre vehicules<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add-category.php">Add marque</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add_model.php">Add model</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add_concessionnaire.php"> concessionnaire</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="p-v.php"> lib recette</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add-garage.php"> Garage</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add-test.php"> vsmt</a>
                            </li>
                           
                        </ul>
                        <!-- second-level-items -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Document administratif<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add-asr.php">Assurance</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add-pat.php">Patente</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add-vign.php">Vignette</a>
                            </li>
                           
                        </ul>
                        <!-- second-level-items -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Registre des parametrages<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-concessionnaire.php">liste des concessionnaire</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-model.php">liste des model</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-category.php">liste des marques</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-recette.php">liste lib recette</a>
                            </li>
                           
                        </ul>
                        <ul class="nav nav-second-level">
                        <li>
                                <a href="manage-garage.php">liste des garages</a>
                            </li>
                           
                        </ul>
                        <!-- second-level-items -->
                    </li>
                    
                   
                    
                    <li>
                        <a href="search-pass.php"><i class="fa fa-search"></i>  Search<span class="fa arrow"></span></a>
                        
                        </li>
                        <li>
                        <a href="pass-bwdates-report.php"><i class="fa fa-folder"></i>  chauffeur<span class="fa arrow"></span></a>
                        
                        </li>
                        <li>
                        <a href="periode.php"><i class="fa fa-folder"></i>  recherche deux date<span class="fa arrow"></span></a>
                        
                        </li>
                        <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Pages<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="aboutus.php">About Us</a>
                            </li>
                            <li>
                                <a href="contactus.php">Contact Us</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    </li>

                      

                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>