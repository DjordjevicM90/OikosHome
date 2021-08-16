
<div class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top text-center">
    <div class="container-fluid px-3">

        <a href="#" class="navbar-brand text-warning" ><h2>Oikos Home</h2></a>

        <div id="search-container">
            <i class="fas fa-search text-light mt-2"></i>
            <input id="search-input" type="text" name="search" placeholder="Search" autocomplete="off">  
            <div id="search-list" class="bg-light text-dark">
            
            </div> 
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Main page</a>
                </li>
                
                <li class="nav-item dropdown">

                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Products</a>

                    <ul class="dropdown-menu">
                        <?php                                                               
                            foreach ($selectCategory as $key => $object) {
                                $categoryId= $object->category_id;
                                $categoryName= $object->category_name;
                                echo "<li><a href='products.php?category=$categoryId' class='dropdown-item' data-id='$categoryId'>$categoryName</a></li>";
                            }
                        ?>                         
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#footer" class="nav-link">Contact</a>
                </li>
                <?php
                    if(!login())
                    {
                        
                ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#signIn">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#registration">Registration</a>
                    </li>
                <?php
                    }
                    else 
                    {
                ?>
                    <li class="nav-item">
                        <a href="profile.php?profile" class="nav-link" id="session-id" data-session=<?= $_SESSION['user_id']?>><?= $_SESSION['user_name'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="basket.php?basket" class="nav-link">
                            <i class="fas fa-shopping-cart position-relative ">
                                <span id="quantity-cart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                                    
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </i></a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php?logoff" class="nav-link">Log out</a>
                    </li>
                <?php 
                    }
                ?>
                
            </ul>
        </div>    
    </div>
</div>

    <!-- Modal Sign in-->
    <div class="modal fade" id="signIn" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enrollLabel">Sign in</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="mb-3">
                            <label for="first-name" class="col-form-label">Email name</label>
                            <input type="email" class="form-control" id="email-login">
                        </div>
                        <div class="mb-3">
                            <label for="first-name" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password-login">
                        </div>    
                    </form>
                </div>
                <div class="form-check m-4">
                    <input class="form-check-input" type="checkbox" value="" id="remember">
                    <label class="form-check-label" for="flexCheckDefault">
                        Remember me
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-login">Submit</button>
                </div>
                <p id="answer-login" class="text-center"></p>
            </div>
        </div>
    </div>

    <!-- Modal Registration-->
    <div class="modal fade" id="registration" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enrollLabel">Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="mb-3">
                            <label for="first-name" class="col-form-label">First name</label>
                            <input type="text" class="form-control" id="first-name-registration">
                        </div>
                        <div class="mb-3">
                            <label for="first-name" class="col-form-label">Last name</label>
                            <input type="text" class="form-control" id="last-name-registration">
                        </div>
                        <div class="mb-3">
                            <label for="first-name" class="col-form-label">Email name</label>
                            <input type="email" class="form-control" id="email-registration">
                        </div>
                        <div class="mb-3">
                            <label for="first-name" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password-registration">
                        </div>
                        <div class="mb-3">
                            <label for="first-name" class="col-form-label">Repeat password</label>
                            <input type="password" class="form-control" id="repeat-password-registration">
                        </div>                  
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-registration">Submit</button>        
                </div>
                <p id="answer-registration" class="text-center"></p>
            </div>
        </div>
    </div>