<?php $this->load->view('layouts/header', ['title' => 'Tableau de bord', 'active' => 'dashboard']); ?>

<div style="max-width:1200px; margin:0 auto; padding:2.5rem 2rem;">

    <!-- En-tête de page -->
    <div class="content-header">
        <div class="page-label">Espace personnel</div>
        <h1>Bonjour, <?= $user['prenom'] ?? 'Utilisateur' ?> 👋</h1>
        <p>Voici un résumé de votre programme santé du jour.</p>
    </div>

    <!-- IMC + Statistiques -->
    <div class="grid-2" style="margin-bottom:2rem;">

        <!-- IMC Card -->
        <div class="imc-card">
            <div class="imc-label">Votre IMC actuel</div>
            <div class="imc-value"><?= $imc ?? '22.4' ?></div>
            <div class="imc-category"><?= $imc_label ?? 'Poids normal' ?></div>
            <div class="imc-scale">
                <div class="imc-scale-seg"></div>
                <div class="imc-scale-seg"></div>
                <div class="imc-scale-seg"></div>
                <div class="imc-scale-seg"></div>
            </div>
            <div class="imc-scale-labels">
                <span>Maigreur</span>
                <span>Normal</span>
                <span>Surpoids</span>
                <span>Obésité</span>
            </div>
        </div>

        <!-- Infos rapides -->
        <div style="display:flex; flex-direction:column; gap:1rem;">
            <div class="stats-grid" style="grid-template-columns:1fr 1fr; margin-bottom:0;">
                <div class="stat-card">
                    <div class="stat-value"><?= $user['poids'] ?? '70' ?> kg</div>
                    <div class="stat-label">Poids actuel</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?= $user['taille'] ?? '175' ?> cm</div>
                    <div class="stat-label">Taille</div>
                </div>
            </div>
            <div class="card" style="flex:1;">
                <div class="card-header">
                    <span class="card-title">Portefeuille</span>
                    <a href="<?= base_url('profil/wallet') ?>" class="btn btn-ghost btn-sm">+ Recharger</a>
                </div>
                <div style="font-family:'Playfair Display',serif; font-size:2rem; font-weight:700; color:var(--red-600);">
                    <?= number_format($user['wallet'] ?? 0, 0, ',', ' ') ?> Ar
                </div>
                <div class="text-muted mt-1">Entrez un code de recharge pour ajouter des fonds</div>
            </div>
        </div>
    </div>

    <!-- Gold Banner si non gold -->
    <?php if(empty($user['is_gold'])): ?>
    <div class="gold-banner">
        <div class="gold-banner-left">
            <h3>✦ Passez à l'option Gold</h3>
            <p>Bénéficiez de 15% de remise sur tous vos régimes alimentaires dès maintenant.</p>
        </div>
        <a href="<?= base_url('gold/upgrade') ?>" class="btn btn-ghost" style="background:rgba(255,255,255,0.15); color:white; border-color:rgba(255,255,255,0.3); flex-shrink:0;">
            Découvrir l'offre Gold →
        </a>
    </div>
    <?php endif; ?>

    <!-- Mon régime actif -->
    <div class="card" style="margin-bottom:1.5rem;">
        <div class="card-header">
            <span class="card-title">Mon régime actif</span>
            <div style="display:flex; gap:8px;">
                <a href="<?= base_url('regime/export') ?>" class="btn btn-outline btn-sm">⬇ Exporter PDF</a>
                <a href="<?= base_url('regime') ?>" class="btn btn-primary btn-sm">Changer de régime</a>
            </div>
        </div>
        <?php if(isset($regime_actif)): ?>
        <div style="display:grid; grid-template-columns:1fr 2fr; gap:2rem; align-items:center;">
            <div>
                <div style="font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700; margin-bottom:4px;"><?= $regime_actif['nom'] ?></div>
                <div class="text-muted">Durée : <?= $regime_actif['duree'] ?> semaines</div>
                <div style="margin-top:1rem; display:flex; gap:8px;">
                    <div class="macro-pill">
                        <div class="macro-pct"><?= $regime_actif['viande'] ?>%</div>
                        <div class="macro-lbl">Viande</div>
                    </div>
                    <div class="macro-pill">
                        <div class="macro-pct"><?= $regime_actif['poisson'] ?>%</div>
                        <div class="macro-lbl">Poisson</div>
                    </div>
                    <div class="macro-pill">
                        <div class="macro-pct"><?= $regime_actif['volaille'] ?>%</div>
                        <div class="macro-lbl">Volaille</div>
                    </div>
                </div>
            </div>
            <div>
                <div style="display:flex; justify-content:space-between; font-size:0.82rem; color:var(--dark-500); margin-bottom:6px;">
                    <span>Progression</span>
                    <span><?= $regime_actif['progression'] ?? 40 ?>%</span>
                </div>
                <div style="height:8px; background:var(--dark-100); border-radius:4px; overflow:hidden;">
                    <div style="height:100%; width:<?= $regime_actif['progression'] ?? 40 ?>%; background:var(--red-600); border-radius:4px;"></div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div style="text-align:center; padding:2rem; color:var(--dark-500);">
            <div style="font-size:2rem; margin-bottom:8px;">🥗</div>
            <p>Aucun régime actif. Explorez nos programmes !</p>
            <a href="<?= base_url('regime') ?>" class="btn btn-primary" style="margin-top:1rem;">Choisir un régime</a>
        </div>
        <?php endif; ?>
    </div>

    <!-- Activités sportives suggérées -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">Activités suggérées</span>
            <a href="<?= base_url('activite') ?>" class="btn btn-ghost btn-sm">Voir toutes →</a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:1rem;">
            <?php foreach($activites ?? [] as $act): ?>
            <div style="padding:1rem; background:var(--dark-100); border-radius:var(--radius-md); border:1px solid var(--dark-200);">
                <div style="font-size:1.5rem; margin-bottom:6px;"><?= $act['emoji'] ?? '🏃' ?></div>
                <div style="font-weight:600; font-size:0.9rem;"><?= $act['nom'] ?></div>
                <div class="text-muted"><?= $act['duree'] ?> min / jour</div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?php $this->load->view('layouts/footer'); ?>
