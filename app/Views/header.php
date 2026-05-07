<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'NutriPlan' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <?= $extra_css ?? '' ?>
</head>
<body class="<?= $body_class ?? '' ?>">

<!-- NAVBAR TOP -->
<nav class="navbar">
    <div class="navbar-brand">
        <span class="brand-icon">✦</span>
        <span class="brand-name">Nutri<span class="brand-accent">Plan</span></span>
    </div>

    <ul class="navbar-nav">
        <li><a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($active ?? '') === 'dashboard' ? 'active' : '' ?>">Tableau de bord</a></li>
        <li><a href="<?= base_url('regime') ?>" class="nav-link <?= ($active ?? '') === 'regime' ? 'active' : '' ?>">Régimes</a></li>
        <li><a href="<?= base_url('activite') ?>" class="nav-link <?= ($active ?? '') === 'activite' ? 'active' : '' ?>">Activités</a></li>
        <li><a href="<?= base_url('profil') ?>" class="nav-link <?= ($active ?? '') === 'profil' ? 'active' : '' ?>">Mon Profil</a></li>
    </ul>

    <div class="navbar-right">
        <div class="wallet-badge">
            <span class="wallet-icon">◈</span>
            <span class="wallet-amount"><?= $wallet ?? '0' ?> Ar</span>
        </div>
        <?php if(isset($is_gold) && $is_gold): ?>
        <span class="gold-badge">✦ GOLD</span>
        <?php endif; ?>
        <div class="user-avatar">
            <span><?= strtoupper(substr($user_name ?? 'U', 0, 2)) ?></span>
        </div>
        <a href="<?= base_url('auth/logout') ?>" class="btn-logout">Déconnexion</a>
    </div>
</nav>

<div class="page-wrapper">
