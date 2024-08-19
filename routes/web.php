<?php

use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\member\JoinController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;

use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\DistributeController;
use App\Http\Controllers\Admin\CenterController;
use App\Http\Controllers\MainController;

###################### 미인증 페이지 START ###########################

Route::get('/', function () {
    return view('pages.main');
});

Route::prefix('/newsandmedia')->group(function () {
    Route::get('/news', function () {
        return view('pages.newsandmedia.news');
    });

    Route::get('/videos', function () {
        return view('pages.newsandmedia.videos');
    });
});
Route::prefix('/brand')->group(function () {
    Route::get('/', function () {
        return view('pages.brand.brand');
    });
});
Route::prefix('/about')->group(function () {
    Route::get('history', function () {
        return view('pages.about.history');
    });
});


// 언어 변경
Route::get('/set-language/{lang}', [LanguageController::class, 'setLanguage'])->name('setLanguage');

// 회원가입 페이지
Route::get('/signup/{recommendId?}', [JoinController::class, 'signup'])->name('signup');
Route::get('/check-id', [JoinController::class, 'checkId']);
Route::get('/check-recommend-id', [JoinController::class, 'checkRecommendId']);
// 회원등록
Route::post('/register', [JoinController::class, 'register'])->name('register');
// ck에디터 업로드
Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');

Route::post('/login/perform', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

###################### 미인증 페이지 END ###########################


###################### 인증 페이지 START###########################
Route::group(['middleware' => 'auth'], function () {

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    

    Route::prefix('/management')->group(function () {
        Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');

        /** 내정보 관리 */
        Route::prefix('/member')->group(function () {
            Route::get('/', [MemberController::class, 'info'])->name('member.info');

            Route::post('/member/update-basic', [MemberController::class, 'updateBasicInformation'])->name('member.update.basic');
            Route::post('/member/update-account', [MemberController::class, 'updateAccountInformation'])->name('member.update.account');
            Route::post('/member/update-password', [MemberController::class, 'updatePassword'])->name('member.update.password');
        });





        Route::prefix('/item')->group(function () {
            Route::get('/list', [ItemController::class, 'itemList'])->name('basic-layouts-item-list');
            Route::get('/register/{seq?}', [ItemController::class, 'itemRegister'])->name('basic-layouts-item-register');
            Route::post('/save', [ItemController::class, 'itemSave'])->name('item.save');
            Route::get('/del/{seq?}', [ItemController::class, 'itemDel'])->name('item.del');
        });

        Route::prefix('/center')->group(function () {
            Route::get('/list', [CenterController::class, 'centerList'])->name('basic-layouts-center-list');
            Route::get('/register/{seq?}', [CenterController::class, 'centerRegister'])->name('basic-layouts-center-register');
            Route::post('/save', [CenterController::class, 'centerSave'])->name('center.save');
            Route::get('/del/{seq?}', [CenterController::class, 'centerDel'])->name('center.del');
        });

        Route::prefix('/distribute')->group(function () {
            Route::get('/list', [DistributeController::class, 'distributeList'])->name('basic-layouts-distribute-list');
            Route::get('/register/{seq?}', [DistributeController::class, 'distributeRegister'])->name('basic-layouts-distribute-register');
            Route::post('/save', [DistributeController::class, 'distributeSave'])->name('distribute.save');
            Route::get('/del/{seq?}', [DistributeController::class, 'distributeDel'])->name('distribute.del');
        });

        // layout
        Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
        Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
        Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
        Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
        Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

        // pages
        Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
        Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
        Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
        Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
        Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

        // authentication
        Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
        Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
        Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

        // cards
        Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

        // User Interface
        Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
        Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
        Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
        Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
        Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
        Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
        Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
        Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
        Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
        Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
        Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
        Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
        Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
        Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
        Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
        Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
        Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
        Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
        Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

        // extended ui
        Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
        Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

        // icons
        Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

        // form elements
        Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
        Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

        // form layouts
        Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
        Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

        // tables
        Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');
    });
});
###################### 인증 페이지 END ###########################