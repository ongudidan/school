<?php

use yii\helpers\Url;

// Get the current URL
$currentUrl = Url::current();

// Define menu items
$menuItems = [
    ['label' => 'Users', 'url' => '/users/index', 'submenu' => [
        ['label' => 'All Users', 'url' => '/users/index'],
        ['label' => 'Create User', 'url' => '/users/create'],
    ]],
    ['label' => 'Teachers', 'url' => '/teachers/index', 'submenu' => [
        ['label' => 'All Teachers', 'url' => '/teachers/index'],
        ['label' => 'Create Teacher', 'url' => '/teachers/create'],
    ]],
    ['label' => 'Students', 'url' => '/students/index', 'submenu' => [
        ['label' => 'All Students', 'url' => '/students/index'],
        ['label' => 'Create student', 'url' => '/students/create'],
    ]],
    ['label' => 'Classes', 'url' => '#', 'submenu' => [
        ['label' => 'All classes', 'url' => '/classes/index'],
        ['label' => 'Create Class', 'url' => '/classes/create'],
    ]],
];
?>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= Url::to('/') ?>"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span class="logo-name">Otika</span></a>
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
                        <i data-feather="monitor"></i><span><?= htmlspecialchars($item['label']) ?></span>
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