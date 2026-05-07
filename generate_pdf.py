#!/usr/bin/env python3
"""
Script de conversion TODO.md en PDF avec images
Génère un rapport PDF professionnel
"""

from reportlab.lib.pagesizes import letter, A4
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib.units import inch, cm
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, PageBreak, Table, TableStyle, Image as RLImage
from reportlab.lib import colors
from reportlab.lib.enums import TA_CENTER, TA_LEFT, TA_JUSTIFY
import os
from datetime import datetime

# Configuration
OUTPUT_FILE = "TODO_Bibliotheque.pdf"
SCRIPT_DIR = "/home/itu/BOSS/S4/SI/Bibliotheque"
IMAGES = {
    "Page d'Accueil": "image.png",
    "Modal Prêt": "image-1.png",
    "Modal Retour": "image-2.png",
    "Ajouter Livre": "image-3.png",
    "Détails Livre": "image-4.png",
    "Messages Flash": "image-5.png",
}

def create_pdf():
    """Crée le PDF avec images"""
    
    # Initialisation du document
    doc = SimpleDocTemplate(
        os.path.join(SCRIPT_DIR, OUTPUT_FILE),
        pagesize=A4,
        rightMargin=15*mm,
        leftMargin=15*mm,
        topMargin=20*mm,
        bottomMargin=20*mm,
    )
    
    # Styles personnalisés
    styles = getSampleStyleSheet()
    title_style = ParagraphStyle(
        'CustomTitle',
        parent=styles['Heading1'],
        fontSize=24,
        textColor=colors.HexColor('#1a3a52'),
        alignment=TA_CENTER,
        spaceAfter=30,
        fontName='Helvetica-Bold',
    )
    
    heading1_style = ParagraphStyle(
        'CustomHeading1',
        parent=styles['Heading2'],
        fontSize=14,
        textColor=colors.HexColor('#2c5aa0'),
        spaceAfter=10,
        spaceBefore=10,
        fontName='Helvetica-Bold',
    )
    
    heading2_style = ParagraphStyle(
        'CustomHeading2',
        parent=styles['Heading3'],
        fontSize=11,
        textColor=colors.HexColor('#444444'),
        spaceAfter=8,
        spaceBefore=5,
        fontName='Helvetica-Bold',
    )
    
    body_style = ParagraphStyle(
        'CustomBody',
        parent=styles['BodyText'],
        fontSize=10,
        alignment=TA_JUSTIFY,
        spaceAfter=6,
    )
    
    # Conteneur des éléments
    elements = []
    
    mm = cm / 10  # Pour convertir en mm
    
    # Page de titre
    elements.append(Spacer(1, 2*cm))
    elements.append(Paragraph("Gestion de Bibliothèque", title_style))
    elements.append(Paragraph("CodeIgniter 4", title_style))
    elements.append(Spacer(1, 1*cm))
    
    info_data = [
        ['Date:', datetime.now().strftime("%d/%m/%Y à %H:%M")],
        ['Projet:', 'TP - Application CodeIgniter 4'],
        ['Version:', '1.0 - Complètement fonctionnelle'],
    ]
    
    info_table = Table(info_data, colWidths=[3*cm, 12*cm])
    info_table.setStyle(TableStyle([
        ('ALIGN', (0, 0), (-1, -1), 'LEFT'),
        ('FONTNAME', (0, 0), (0, -1), 'Helvetica-Bold'),
        ('FONTSIZE', (0, 0), (-1, -1), 10),
        ('TEXTCOLOR', (0, 0), (0, -1), colors.HexColor('#2c5aa0')),
    ]))
    elements.append(info_table)
    elements.append(PageBreak())
    
    # Table des matières
    elements.append(Paragraph("Table des Matières", heading1_style))
    elements.append(Spacer(1, 0.5*cm))
    
    toc_items = [
        "1. Tâches Complétées (Phases 1-6)",
        "2. Tâches Restantes",
        "3. Captures d'Écran",
        "4. Notes de Développement",
        "5. Critères d'Évaluation",
    ]
    
    for item in toc_items:
        elements.append(Paragraph(item, body_style))
    
    elements.append(PageBreak())
    
    # Section 1: Tâches Complétées
    elements.append(Paragraph("1. Tâches Complétées ✅", heading1_style))
    elements.append(Spacer(1, 0.3*cm))
    
    phases = [
        ("Phase 1 - Architecture et Base de Données", [
            "✓ Création des tables (livre, categorie, emprunt)",
            "✓ Migration vers socket MySQL XAMPP",
            "✓ Insertion des données de base",
        ]),
        ("Phase 2 - Séparation MVC", [
            "✓ Création LivreModel.php",
            "✓ Création EmpruntModel.php",
            "✓ Création LivreController.php",
            "✓ Création EmpruntController.php",
            "✓ Mise à jour des routes",
        ]),
        ("Phase 3 - Layout Principal", [
            "✓ Création main.php (layout principal)",
            "✓ Création navbar.php (navigation)",
            "✓ Création flash_messages.php (messages)",
            "✓ Création footer.php (pied de page)",
            "✓ Intégration dans toutes les vues",
        ]),
        ("Phase 4 - Sécurité CSRF et XSS", [
            "✓ Vérifier CSRF sur tous les POST",
            "✓ Ajouter esc() sur tous les affichages",
            "✓ Validation des données en entrée",
            "✓ Validation des fichiers images",
            "✓ Gestion d'erreurs",
        ]),
        ("Phase 5 - Fonctionnalités Modales", [
            "✓ Contrôleur Emprunt - support dates",
            "✓ Modèle Emprunt - support dates prévues",
            "✓ Validation des dates",
            "✓ Modales Bootstrap pour prêt",
            "✓ Modales Bootstrap pour retour",
        ]),
        ("Phase 6 - Conformité et Documentation", [
            "✓ Vérifier pagination (visible dès 11 livres)",
            "✓ Vérifier CRUD complet",
            "✓ Vérifier validation formulaires",
            "✓ Créer CONFORMITE.md",
        ]),
    ]
    
    for phase_title, tasks in phases:
        elements.append(Paragraph(phase_title, heading2_style))
        for task in tasks:
            elements.append(Paragraph(task, body_style))
        elements.append(Spacer(1, 0.2*cm))
    
    elements.append(PageBreak())
    
    # Section 2: Tâches Restantes
    elements.append(Paragraph("2. Tâches Restantes ⏳", heading1_style))
    elements.append(Spacer(1, 0.3*cm))
    
    remaining = [
        "✗ Tester les modales prêt/retour en production",
        "✗ Ajouter captures d'écran de l'interface",
        "✗ Documenter l'API REST (optionnel)",
        "✗ Optimiser les requêtes SQL",
        "✗ Ajouter des tests unitaires",
    ]
    
    for task in remaining:
        elements.append(Paragraph(task, body_style))
    
    elements.append(PageBreak())
    
    # Section 3: Captures d'Écran
    elements.append(Paragraph("3. Captures d'Écran 📸", heading1_style))
    elements.append(Spacer(1, 0.3*cm))
    
    for title, image_file in IMAGES.items():
        image_path = os.path.join(SCRIPT_DIR, image_file)
        if os.path.exists(image_path):
            elements.append(Paragraph(title, heading2_style))
            elements.append(Spacer(1, 0.2*cm))
            
            # Insérer l'image
            try:
                img = RLImage(image_path, width=17*cm, height=10*cm)
                elements.append(img)
                elements.append(Spacer(1, 0.5*cm))
            except Exception as e:
                elements.append(Paragraph(f"[Erreur: Image non trouvée - {image_file}]", body_style))
        
        elements.append(PageBreak())
    
    # Section 4: Notes de Développement
    elements.append(Paragraph("4. Notes de Développement", heading1_style))
    elements.append(Spacer(1, 0.3*cm))
    
    elements.append(Paragraph("Répertoires Clés", heading2_style))
    
    dir_data = [
        ['Dossier', 'Fichier', 'Statut'],
        ['Controllers/', 'Livre.php', '✅ Gestion des livres'],
        ['', 'Emprunt.php', '✅ Gestion des emprunts'],
        ['Models/', 'LivreModel.php', '✅ ORM Livre'],
        ['', 'EmpruntModel.php', '✅ ORM Emprunt'],
        ['Views/', 'layout/', '✅ Layouts réutilisables'],
        ['', 'bibliotheque/', '✅ Pages métier'],
        ['Config/', 'Routes.php', '✅ Routing'],
        ['', 'Database.php', '✅ Config BD (socket XAMPP)'],
    ]
    
    dir_table = Table(dir_data, colWidths=[3*cm, 5*cm, 7*cm])
    dir_table.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, 0), colors.HexColor('#2c5aa0')),
        ('TEXTCOLOR', (0, 0), (-1, 0), colors.whitesmoke),
        ('ALIGN', (0, 0), (-1, -1), 'LEFT'),
        ('FONTNAME', (0, 0), (-1, 0), 'Helvetica-Bold'),
        ('FONTSIZE', (0, 0), (-1, 0), 9),
        ('BOTTOMPADDING', (0, 0), (-1, 0), 12),
        ('BACKGROUND', (0, 1), (-1, -1), colors.beige),
        ('GRID', (0, 0), (-1, -1), 1, colors.black),
        ('FONTSIZE', (0, 1), (-1, -1), 8),
    ]))
    elements.append(dir_table)
    elements.append(Spacer(1, 0.5*cm))
    
    elements.append(Paragraph("Conventions de Sécurité", heading2_style))
    
    sec_items = [
        "✅ CSRF: csrf_field() sur tous les POST",
        "✅ XSS: esc() sur tous les affichages",
        "✅ SQL Injection: Query Builder avec paramètres liés",
        "✅ File Upload: Validation MIME + taille",
        "✅ Validation: Côté contrôleur avec messages d'erreur",
    ]
    
    for item in sec_items:
        elements.append(Paragraph(item, body_style))
    
    elements.append(PageBreak())
    
    # Section 5: Critères d'Évaluation
    elements.append(Paragraph("5. Critères d'Évaluation", heading1_style))
    elements.append(Spacer(1, 0.3*cm))
    
    criteria_data = [
        ['Critère', 'Statut'],
        ['Fonctionnement CRUD', '✅ Complet'],
        ['Validation formulaires', '✅ Implémentée'],
        ['Protection CSRF', '✅ Active'],
        ['Gestion statut', '✅ Prêt/Disponible'],
        ['Pagination', '✅ À partir de 11 livres'],
        ['Validation images', '✅ Type + taille'],
        ['Pattern MVC', '✅ Respecté'],
        ['Vues propres', '✅ Layout commun'],
        ['esc() sur affichages', '✅ Systématique'],
    ]
    
    criteria_table = Table(criteria_data, colWidths=[10*cm, 5*cm])
    criteria_table.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, 0), colors.HexColor('#2c5aa0')),
        ('TEXTCOLOR', (0, 0), (-1, 0), colors.whitesmoke),
        ('ALIGN', (0, 0), (-1, -1), 'LEFT'),
        ('FONTNAME', (0, 0), (-1, 0), 'Helvetica-Bold'),
        ('FONTSIZE', (0, 0), (-1, 0), 11),
        ('BOTTOMPADDING', (0, 0), (-1, 0), 12),
        ('BACKGROUND', (0, 1), (-1, -1), colors.lightblue),
        ('GRID', (0, 0), (-1, -1), 1, colors.black),
        ('FONTSIZE', (0, 1), (-1, -1), 10),
        ('FONTNAME', (1, 1), (1, -1), 'Helvetica-Bold'),
        ('TEXTCOLOR', (1, 1), (1, -1), colors.HexColor('#006600')),
    ]))
    elements.append(criteria_table)
    
    elements.append(Spacer(1, 1*cm))
    
    # Pied de page
    elements.append(Paragraph("─" * 80, body_style))
    elements.append(Spacer(1, 0.3*cm))
    footer_text = f"Document généré le {datetime.now().strftime('%d/%m/%Y à %H:%M')} | CodeIgniter 4 Gestion de Bibliothèque"
    elements.append(Paragraph(footer_text, ParagraphStyle(
        'Footer',
        parent=styles['Normal'],
        fontSize=8,
        textColor=colors.grey,
        alignment=TA_CENTER,
    )))
    
    # Construction du PDF
    try:
        doc.build(elements)
        print(f"✅ PDF généré avec succès: {os.path.join(SCRIPT_DIR, OUTPUT_FILE)}")
        return True
    except Exception as e:
        print(f"❌ Erreur lors de la génération du PDF: {e}")
        return False

if __name__ == "__main__":
    create_pdf()
