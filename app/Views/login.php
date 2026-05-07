<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — NutriPlan</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
<div class="auth-layout">

    <!-- Panel gauche décoratif -->
    <div class="auth-panel-left">
        <div>
            <div class="navbar-brand" style="margin-bottom: 3rem; justify-content: flex-start;">
                <span class="brand-icon" style="color:rgba(255,255,255,0.7)">✦</span>
                <span style="font-family:'Playfair Display',serif; font-size:1.5rem; font-weight:700; color:white;">NutriPlan</span>
            </div>
            <p class="big-title">Votre corps,<br>votre programme.</p>
            <p>Découvrez un régime alimentaire personnalisé selon vos objectifs de santé. Calculez votre IMC et transformez votre quotidien.</p>
            <div style="display:flex; gap:2rem; margin-top:2.5rem; position:relative; z-index:1;">
                <div>
                    <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700;">500+</div>
                    <div style="font-size:0.8rem; opacity:0.75;">Utilisateurs actifs</div>
                </div>
                <div>
                    <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700;">5</div>
                    <div style="font-size:0.8rem; opacity:0.75;">Régimes disponibles</div>
                </div>
                <div>
                    <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700;">15%</div>
                    <div style="font-size:0.8rem; opacity:0.75;">Remise Gold</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel droit : formulaire -->
    <div class="auth-panel-right">
        <div class="auth-box">
            <h2>Bon retour ✦</h2>
            <p>Connectez-vous à votre compte NutriPlan</p>

            <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form action="<?= base_url('auth/login') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label class="form-label" for="email">Adresse email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="vous@exemple.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div style="display:flex; justify-content:flex-end; margin:-0.5rem 0 1.25rem;">
                    <a href="<?= base_url('auth/forgot') ?>" style="font-size:0.82rem; color:var(--red-600);">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-full btn-lg">Se connecter</button>
            </form>

            <div class="divider"></div>
            <p style="text-align:center; font-size:0.88rem; color:var(--dark-500);">
                Pas encore de compte ?
                <a href="<?= base_url('auth/register') ?>" style="color:var(--red-600); font-weight:500;">Créer un compte</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
