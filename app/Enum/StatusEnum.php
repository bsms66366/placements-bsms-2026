<?php
  
namespace App\StatusEnums;
 
enum StatusEnum:String {
    case SessionNote = 'Session Note';
    case PathologyPot = 'Pathology Pot';
    case Program = 'PA Program';
    case Module101 = 'Module 101';
    case Module102 = 'Module 102';
    case Module103 = 'Module 103';
    case Module104 = 'Module 104';
    case Module201 = 'Module 201';
    case Module202 = 'Module 202';
    case Module203 = 'Module 203';
    case Module204 = 'Module 204';
    case PostGraduate = 'Post Graduate';
    case Video = 'Video';
    case MedicalNeuroscience = 'Medical Neuroscience';
    case Pharmacy = 'Pharmacy';
    case HealthProfessionals = 'Health Professionals';
    case BiomedicalScience = 'Biomedical science';
    case Radiology = 'Radiology';
    case ENT = 'ENT';
    case PublicDisplay = 'Public Display';
    case HeadNeckBrain = 'Head Neck Brain';
    case IntroductionTo = 'Introduction To';
    case EarNoseThroat = 'Ear Nose Throat';
    case Thorax = 'Thorax';
    case AbdomenPelvis = 'Abdomen and Pelvis';
    case BackLimbs = 'Back and Limbs';
    case Embryology = 'Embryology';
    case SussexPanopto = 'Sussex Panopto';
    case BrightonPanopto = 'BrightonPanopto';
    case Miscellaneous = 'Miscellaneous';
}
