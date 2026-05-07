# Checklist de Conformité - TP CodeIgniter 4

## 8.2 - Protection CSRF
✅ **Tous les formulaires POST contiennent le jeton CSRF**

- [app/Views/bibliotheque/index.php](app/Views/bibliotheque/index.php) - ligne 116, 159
  - Modal prêt: `<?= csrf_field(); ?>`
  - Modal retour: `<?= csrf_field(); ?>`

- [app/Views/bibliotheque/nouveau.php](app/Views/bibliotheque/nouveau.php) - ligne 13
  - Formulaire ajout livre: `<?= csrf_field(); ?>`

- [app/Views/bibliotheque/detail.php](app/Views/bibliotheque/detail.php) - ligne 59
  - Formulaire suppression: `<?= csrf_field(); ?>`

## 8.3 - Protection XSS (esc() sur tous les affichages)
✅ **Toutes les données dynamiques sont échappées avec esc()**

**Vue index.php** (liste des livres):
- Titre: `<?= esc($livre['titre']); ?>` ligne 74
- Auteur: `<?= esc($livre['auteur']); ?>` ligne 82
- Année: `<?= esc($livre['annee'] ?? '-'); ?>` ligne 83
- Catégorie: `<?= esc($livre['categorie_nom'] ?? 'Sans categorie'); ?>` ligne 84
- Nom emprunteur: `<?= esc($livre['nom_emprunteur']); ?>` ligne 93
- Filtres: `<?= esc($filtres['q'] ?? ''); ?>` ligne 26
- Catégories: `<?= esc($categorie['nom']); ?>` ligne 31
- Modales IDs: `id="modalPret<?= esc($livre['id']); ?>"` ligne 108

**Vue detail.php** (détails du livre):
- Titre: `<?= esc($livre['titre']); ?>` ligne 12
- Auteur: `<?= esc($livre['auteur']); ?>` ligne 21
- Année: `<?= esc($livre['annee'] ?? '-'); ?>` ligne 22
- Catégorie: `<?= esc($livre['categorie_nom'] ?? 'Sans categorie'); ?>` ligne 23
- Statut: `<?= esc($livre['statut']); ?>` ligne 24
- Résumé: `<?php $resume = (string) ($livre['resume'] ?? 'Aucun resume disponible.'); echo nl2br(esc($resume)); ?>` ligne 37-38
- Emprunteur: `<?= esc($dernierEmprunt['nom_emprunteur']); ?>` ligne 48

**Vue nouveau.php** (ajout livre):
- Titre: `value="<?= old('titre'); ?>"` (old() échappe automatiquement)
- Catégories: `<?= esc($categorie['nom']); ?>` ligne 45

## Critères d'Évaluation

### Fonctionnement CRUD
✅ CRUD complet implémenté:
- [app/Controllers/Livre.php](app/Controllers/Livre.php) - Create, Read, Delete
- [app/Controllers/Emprunt.php](app/Controllers/Emprunt.php) - Gestion des emprunts/retours

### Validation et Erreurs
✅ Validation en place:
- [app/Controllers/Livre.php](app/Controllers/Livre.php) ligne 66-71 - Règles de validation
- Messages d'erreur affichés via [app/Views/layout/flash_messages.php](app/Views/layout/flash_messages.php)

### Protection CSRF
✅ Active par défaut et vérifiée sur tous les POST (voir 8.2 ci-dessus)

### Gestion du Statut (Disponible/Prêté)
✅ Implémentée:
- [app/Models/EmpruntModel.php](app/Models/EmpruntModel.php) - `preterLivre()` change statut à "Prêté"
- [app/Models/EmpruntModel.php](app/Models/EmpruntModel.php) - `rendreLivre()` change statut à "Disponible"
- Boutons désactivés/modifiés selon le statut

### Pagination
✅ Visible dès 11 livres:
- [app/Models/LivreModel.php](app/Models/LivreModel.php) ligne 42-62 - `getLivresPaginesFiltres()` avec perPage=10
- [app/Views/bibliotheque/index.php](app/Views/bibliotheque/index.php) ligne 125-148 - Affichage pagination

### Validation du Fichier Image
✅ Validée:
- [app/Controllers/Livre.php](app/Controllers/Livre.php) ligne 82-96
  - Type MIME: jpeg, png, webp
  - Taille max: 2 Mo
  - Vérification que c'est une image valide avec `getimagesize()`

### Organisation MVC
✅ Structure respectée:
- **Models**: [app/Models/LivreModel.php](app/Models/LivreModel.php), [app/Models/EmpruntModel.php](app/Models/EmpruntModel.php)
- **Controllers**: [app/Controllers/Livre.php](app/Controllers/Livre.php), [app/Controllers/Emprunt.php](app/Controllers/Emprunt.php)
- **Views**: [app/Views/bibliotheque/](app/Views/bibliotheque/) avec layout commun
- **Config**: [app/Config/Database.php](app/Config/Database.php), [app/Config/Routes.php](app/Config/Routes.php)

### Vues Propres
✅ Respectent les bonnes pratiques:
- Utilisation du layout principal [app/Views/layout/main.php](app/Views/layout/main.php)
- Navigation réutilisable [app/Views/layout/navbar.php](app/Views/layout/navbar.php)
- Messages flash [app/Views/layout/flash_messages.php](app/Views/layout/flash_messages.php)
- Tous les affichages utilisent `esc()` (voir 8.3 ci-dessus)
- Responsive Bootstrap 5

## Nouvelles Fonctionnalités

### Modales pour Prêt/Retour
✅ Implémentées:
- [app/Views/bibliotheque/index.php](app/Views/bibliotheque/index.php) ligne 100-168
  - Modal prêt: Saisie du nom + date retour prévue (optionnelle)
  - Modal retour: Saisie de la date de retour (pré-remplie avec la date du jour)

### Support de la Date de Retour Prévue
✅ Depuis les modales dans index.php
- Stockée dans `emprunt.date_retour_prevue`
- Utilisée pour planifier les retours

### Validation des Dates
✅ Validée côté contrôleur:
- [app/Controllers/Emprunt.php](app/Controllers/Emprunt.php) ligne 52-54 - `isValidDate()`
- Formats acceptés: Y-m-d, d/m/Y, d-m-Y

## Sécurité Globale

✅ **XSS Prevention**: Tous les affichages utilisent `esc()`
✅ **CSRF Prevention**: Tous les POST ont `csrf_field()`
✅ **SQL Injection**: Utilisation des Query Builder (requêtes paramétrées)
✅ **File Upload**: Validation du type MIME et taille
✅ **Input Validation**: Validation côté contrôleur avec CodeIgniter Validation
