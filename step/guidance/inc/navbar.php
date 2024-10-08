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
<?php
require_once('loader.php');
?>
<div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
    <div class="d-flex align-items-center p-3">
        <img class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4" style="height: 50px; " src="../../assets/mcc2.png">
        <a href="./" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4">Guidance Office</a>
        <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
    </div>
    <ul class="sidebar-menu p-3 m-0 mb-0">
        <li class="sidebar-menu-item <?php echo isActive('/home/index'); ?>">
            <a href="../home/">
                <i class="ri-dashboard-line sidebar-menu-item-icon"></i>
                Dashboard
            </a>
        </li>
        <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Applicant</li>
        <li class="sidebar-menu-item <?php echo isActive('/new-applicant/index'); ?>">
            <a href="../new-applicant/">
                <i class="ri-account-pin-box-line sidebar-menu-item-icon"></i>
                New Applicant<span style="margin-left: 5px;"  class="badge bg-primary rounded-pill"><span id="new-applicant-side"></span></span>
            </a>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('/accepted-applicant/index'); ?>">
            <a href="../accepted-applicant/">
                <i class="ri-user-received-line sidebar-menu-item-icon"></i>
                Accepted Applicant <span style="margin-left: 5px;" class="badge bg-primary rounded-pill"><span id="accept-applicant-side"></span></span>
            </a>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('/applicant-info/index'); ?>">
            <a href="../applicant-info/">
                <i class="ri-account-pin-box-line sidebar-menu-item-icon"></i>
                Applicant Admission<span style="margin-left: 5px;"  class="badge bg-primary rounded-pill"><span id="form-done-side"></span></span>
            </a>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('/applicantGform/index'); ?>">
            <a href="../applicantGform/">
                <i class="ri-account-pin-box-line sidebar-menu-item-icon"></i>
                Guidance Form Record</span></span>
            </a>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('/applicant-scores/index'); ?>">
            <a href="../applicant-scores/">
                <i class="ri-draft-line sidebar-menu-item-icon"></i>
                Applicant Score<span class="badge bg-primary rounded-pill"></span>
            </a>
        </li>
        <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Queuing</li>
        <li class="sidebar-menu-item <?php echo isActive('/endorse-applicant/index'); ?>">
            <a href="../endorse-applicant/">
                <i class="ri-group-line sidebar-menu-item-icon"></i>
                Endorse Applicant
            </a>
        </li>
        <li class="sidebar-menu-item <?php echo isActive('/queuing/index'); ?>">
            <a href="../queuing/">
                <i class="ri-loader-2-line sidebar-menu-item-icon"></i>
                Que Students
            </a>
        </li>
        <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Admission</li>
        <li class="sidebar-menu-item has-dropdown <?php echo isFocused('/admission-schedule/index'); ?> <?php echo isFocused('/admission-list/index'); ?>">
            <a href="" class="disabled-link">
                <i class="ri-calendar-todo-line sidebar-menu-item-icon"></i>
                Manage Admission
                <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
            </a>
            <ul class="sidebar-dropdown-menu">
                <li class="sidebar-dropdown-menu-item <?php echo isFocused('/admission-schedule/index'); ?>">
                    <a href="../admission-schedule/">
                        Admission Schedule
                    </a>
                </li>
                <li class="sidebar-dropdown-menu-item <?php echo isFocused('/admission-list/index'); ?>">
                    <a href="../admission-list/">
                        Admssion List
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-menu-item has-dropdown <?php echo isFocused('/passed-and-enroll/index'); ?> <?php echo isFocused('/passed-not-enroll/index'); ?> <?php echo isFocused('/not-pass/index'); ?>">
            <a href="" class="disabled-link">
                <i class="ri-article-line sidebar-menu-item-icon"></i>
                Admission Test
                <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
            </a>
            <ul class="sidebar-dropdown-menu">
                <li class="sidebar-dropdown-menu-item <?php echo isFocused('/passed-and-enroll/index'); ?>">
                    <a href="../passed-and-enroll/">
                        Passed and Enrolled
                    </a>
                </li>
                <li class="sidebar-dropdown-menu-item <?php echo isFocused('/passed-not-enroll/index'); ?>">
                    <a href="../passed-not-enroll/">
                        Passed but not Enrolled
                    </a>
                </li>
                <li class="sidebar-dropdown-menu-item <?php echo isFocused('/not-pass/index'); ?>">
                    <a href="../not-pass/">
                        Not Passed
                    </a>
                </li>

            </ul>
        </li>
        <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">System</li>
        <li class="sidebar-menu-item has-dropdown <?php echo isFocused('/mail-entrance-exam/index'); ?>">
            <a href="" class="disabled-link">
                <i class="ri-mail-line sidebar-menu-item-icon"></i>
                Email
                <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
            </a>
            <ul class="sidebar-dropdown-menu">
                <li class="sidebar-dropdown-menu-item <?php echo isFocused('/mail-entrance-exam/index'); ?>">
                    <a href="../mail-entrance-exam/">
                        Entrance Exam
                    </a>
                </li>

            </ul>
        </li>
    </ul>
</div>