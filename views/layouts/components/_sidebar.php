<?php

use yii\helpers\Url;

// Get the current URL
$currentUrl = Url::current();

// Define menu items
$menuItems = [
    ['label' => 'Home', 'icon' => 'monitor', 'url' => '/site/index'],
    // ['label' => 'Users', 'icon' => 'monitor', 'url' => '/users/index'],
    ['label' => 'Teachers', 'icon'=>'command', 'url' => '/teachers/index', 'submenu' => [
        ['label' => 'All Teachers', 'url' => '/teachers/index'],
        ['label' => 'Create Teacher', 'url' => '/teachers/create'],
        ['label' => 'Teacher Subject', 'url' => '/teacher-subjects/index'],
    ]],
    ['label' => 'Students', 'icon'=>'mail', 'url' => '/students/index', 'submenu' => [
        ['label' => 'All Students', 'url' => '/students/index'],
        ['label' => 'Create student', 'url' => '/students/create'],
    ]],
    ['label' => 'Subjects', 'icon'=>'mail', 'url' => '/subjects/index', 'submenu' => [
        ['label' => 'All subjects', 'url' => '/subjects/index'],
        ['label' => 'Create Subject', 'url' => '/subjects/create'],

    ]],
    ['label' => 'Classes', 'icon'=>'copy', 'url' => '#', 'submenu' => [
        ['label' => 'All classes', 'url' => '/classes/index'],
        ['label' => 'Create Class', 'url' => '/classes/create'],
        ['label' => 'Class Teachers', 'icon' => 'heart', 'url' => '/class-teachers/index'],
        ['label' => 'Class Students', 'icon' => 'shield', 'url' => '/class-students/index'],
    ]],
    ['label' => 'Class Teachers', 'icon'=>'mail', 'url' => '/class-teachers/index', 'submenu' => [
        ['label' => 'All class teachers', 'url' => '/class-teachers/index'],
        ['label' => 'Create class Teacher', 'url' => '/class-teachers/create'],

    ]],
    ['label' => 'Class students', 'icon'=>'mail', 'url' => '/class-students/index', 'submenu' => [
        ['label' => 'All class-students', 'url' => '/class-students/index'],
        ['label' => 'Create class student', 'url' => '/class-students/create'],

    ]],


];
?>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= Url::to('/') ?>"> <img alt="image" src="/assets/img/logo.png" class="header-logo" /> <span class="logo-name">Otika</span></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <?php foreach ($menuItems as $item) : ?>
                <?php
                $isActive = ($currentUrl === Url::to($item['url']));
                $hasSubmenu = isset($item['submenu']);
                $submenuActive = false;

                if ($hasSubmenu) {
                    // Check if any submenu item is active
                    foreach ($item['submenu'] as $subitem) {
                        if ($currentUrl === Url::to($subitem['url'])) {
                            $submenuActive = true;
                            break;
                        }
                    }
                    $isActive = $submenuActive; // Parent item is active if any submenu item is active
                }
                ?>
                <li class="dropdown <?= $isActive ? 'active' : '' ?>">
                    <a href="<?= $hasSubmenu ? '#' : Url::to($item['url']) ?>" class="nav-link <?= $hasSubmenu ? 'menu-toggle has-dropdown' : '' ?>">
                        <i data-feather="<?= $item['icon']?>"></i><span><?= htmlspecialchars($item['label']) ?></span>
                    </a>
                    <?php if ($hasSubmenu) : ?>
                        <ul class="dropdown-menu">
                            <?php foreach ($item['submenu'] as $subitem) : ?>
                                <li class="<?= $currentUrl === Url::to($subitem['url']) ? 'active' : '' ?>">
                                    <a class="nav-link" href="<?= Url::to($subitem['url']) ?>"><?= htmlspecialchars($subitem['label']) ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>
</div>