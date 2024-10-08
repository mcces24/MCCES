<?php

// Define the current page
$current_page = $_SERVER['PHP_SELF'];

// Function to check if the menu item is active
function isActive($page)
{
    global $current_page;
    return strpos($current_page, $page) !== false ? 'active' : '';
}
function isFocused($page)
{
    global $current_page;
    return strpos($current_page, $page) !== false ? 'focused' : '';
}
?>
<style>
    .sidebar-menu-item.has-dropdown .sidebar-dropdown-menu {
        display: block !important; 
    }
    .disabled-link {
        pointer-events: none;
        text-decoration: none; /* Remove underline if desired */
        cursor: default; /* Change cursor to default */
    }
</style>
</style>
<div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
    <div class="d-flex align-items-center p-3">
        <img class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4" style="height: 50px; "
            src="../../assets/mcc2.png">
        <a href="index.php" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4">Registrar
            Office </a>
        <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
    </div>
    <ul class="sidebar-menu p-3 m-0 mb-0">
        <li class="sidebar-menu-item <?php echo isActive('/home/index'); ?>">
            <a href="../home/index.php">
                <i class="ri-dashboard-line sidebar-menu-item-icon"></i>
                Dashboard
            </a>
        </li>
        <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Students</li>
        <li class="sidebar-menu-item <?php echo isActive('/new-students/index'); ?>">
            <a href="../new-students/index.php">
                <i class="ri-user-add-line sidebar-menu-item-icon"></i>
                New Students
            </a>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('/old-students/index'); ?>">
            <a href="../old-students/index.php">
                <i class="ri-user-add-line sidebar-menu-item-icon"></i>
                Old Students
            </a>
        </li>
        <!-- <li class="sidebar-menu-item <?php echo isActive('/shift-students/index'); ?>">
            <a href="../shift-students/index.php">
                <i class="ri-user-shared-line sidebar-menu-item-icon"></i>
                Shift Students
            </a>
        </li> -->
        </li>
        <li class="sidebar-menu-item has-dropdown">
            <!-- <li class="sidebar-menu-item <?php echo isActive('/new-applicant/index'); ?>">
            <a href="../new-applicant/index.php">
                <i class="ri-user-add-line sidebar-menu-item-icon"></i>
                New Applicant <span class="badge bg-primary rounded-pill"><span id="noti_number1"></span></span>
            </a>
        </li> -->
        <!-- <li class="sidebar-menu-item <?php echo isActive('/pre-enrollment/index'); ?>">
            <a href="../pre-enrollment/index.php">
                <i class="ri-user-add-line sidebar-menu-item-icon"></i>
                Pre-enrollment Old <span class="badge bg-primary rounded-pill"></span></span>
            </a>
        </li> -->
        <li class="sidebar-menu-item <?php echo isActive('/subjects/index'); ?>">
            <a href="../subjects/index.php">
                <i class="ri-book-2-line sidebar-menu-item-icon"></i>
                Subjects
            </a>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('/students/index'); ?>">
            <a href="../students/index.php?academic">
                <i class="ri-group-line sidebar-menu-item-icon"></i>
                Students
            </a>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('/list-of-enrollee/index'); ?>">
            <a href="../list-of-enrollee/index.php">
                <i class="ri-list-settings-line sidebar-menu-item-icon"></i>
                List of Enrollee
            </a>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('/documents/index'); ?>">
            <a href="../documents/index.php">
                <i class="ri-article-line sidebar-menu-item-icon"></i>
                Documents
            </a>
        </li>
        <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">System</li>
        <li
            class="sidebar-menu-item has-dropdown <?php echo isFocused('/account/index'); ?> <?php echo isFocused('/enrollment-schedule/index'); ?>">
            <a href="#">
                <i class="ri-mail-line sidebar-menu-item-icon"></i>
                Email
                <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
            </a>
            <ul class="sidebar-dropdown-menu">
                <li class="sidebar-dropdown-menu-item <?php echo isFocused('/account/index'); ?> ">
                    <a href="../account/index.php">
                        Account
                    </a>
                </li>
                <li class="sidebar-dropdown-menu-item <?php echo isFocused('/enrollment-schedule/index'); ?>">
                    <a href="../enrollment-schedule/index.php">
                        Enrollment Schedule
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('/report/index'); ?>">
            <a href="../report/index.php">
                <i class="ri-settings-3-line sidebar-menu-item-icon"></i>
                Report
            </a>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('system/index.php'); ?>">
            <a href="../system/index.php">
                <i class="ri-settings-3-line sidebar-menu-item-icon"></i>
                Semester & Academic
            </a>
        </li>
    </ul>
</div>