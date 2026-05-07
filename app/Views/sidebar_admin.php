<!-- SIDEBAR ADMIN -->
<aside class="sidebar">
    <div class="sidebar-logo">
        <span class="brand-icon">✦</span>
        <span class="brand-name">Nutri<span class="brand-accent">Plan</span></span>
        <span class="sidebar-tag">Admin</span>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section">Général</div>
        <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-link <?= ($active ?? '') === 'dashboard' ? 'active' : '' ?>">
            <span class="sidebar-icon">◈</span> Tableau de bord
        </a>
        <a href="<?= base_url('admin/statistiques') ?>" class="sidebar-link <?= ($active ?? '') === 'stats' ? 'active' : '' ?>">
            <span class="sidebar-icon">◉</span> Statistiques
        </a>

        <div class="sidebar-section">Gestion</div>
        <a href="<?= base_url('admin/regimes') ?>" class="sidebar-link <?= ($active ?? '') === 'regimes' ? 'active' : '' ?>">
            <span class="sidebar-icon">◆</span> Régimes
        </a>
        <a href="<?= base_url('admin/activites') ?>" class="sidebar-link <?= ($active ?? '') === 'activites' ? 'active' : '' ?>">
            <span class="sidebar-icon">◇</span> Activités Sportives
        </a>
        <a href="<?= base_url('admin/codes') ?>" class="sidebar-link <?= ($active ?? '') === 'codes' ? 'active' : '' ?>">
            <span class="sidebar-icon">◈</span> Codes Portefeuille
        </a>

        <div class="sidebar-section">Configuration</div>
        <a href="<?= base_url('admin/utilisateurs') ?>" class="sidebar-link <?= ($active ?? '') === 'users' ? 'active' : '' ?>">
            <span class="sidebar-icon">●</span> Utilisateurs
        </a>
        <a href="<?= base_url('admin/parametres') ?>" class="sidebar-link <?= ($active ?? '') === 'params' ? 'active' : '' ?>">
            <span class="sidebar-icon">○</span> Paramètres
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">AD</div>
            <div>
                <div class="sidebar-user-name">Administrateur</div>
                <div class="sidebar-user-role">Super Admin</div>
            </div>
        </div>
        <a href="<?= base_url('admin/logout') ?>" class="sidebar-logout">Déconnexion</a>
    </div>
</aside>
