create table utilisateur(
    idutilisateur int auto_increment primary key,
    nom varchar(50) unique,
    mdp varchar(50)
);

create table objet(
    idObjet int auto_increment primary key,
    titre varchar(50) unique,
    idutilisateur int,
    prixEstimatif double default 0.00,
    etatObjet int default 0,
    foreign key (idutilisateur)
        references utilisateur
);

create table photoObjet(
    idphotoObjet int auto_increment primary key,
    idObjet int,
    nom text,
    foreign key (idObjet)
        references objet(idObjet)
);

create table proposition(
    idproposition int auto_increment primary key,
    offrant int,
    propose int,
    objetOffrant int,
    objetpropose int,
    estvalide boolean default true,
    foreign key (offrant)
        references utilisateur( idutilisateur ), 
    foreign key (propose)
        references utilisateur( idutilisateur ),
    foreign key (objetOffrant)
        references objet( idObjet ), 
    foreign key (objetpropose)
        references objet( idObjet ) 
);

create table categorie(
    idcategorie int auto_increment primary key,
    nom varchar(50),
    icone varchar(50)
);

create table objetCategorie(
    idcategorie int,
    idObjet int,
    foreign key (idObjet)
        references objet(idObjet),
    foreign key (idcategorie)
        references categorie(idcategorie)
);



-- nouvelle table
create table echange(
    idechange int auto_increment primary key,
    offrant int,
    propose int,
    objetOffrant int,
    objetpropose int,
    dateEchange date ,
    foreign key (offrant)
        references utilisateur( idutilisateur ), 
    foreign key (propose)
        references utilisateur( idutilisateur ),
    foreign key (objetOffrant)
        references objet( idObjet ), 
    foreign key (objetpropose)
        references objet( idObjet ) 
);

create table historiqueproprietaire(
    idhp int auto_increment primary key,
    idproprietaire int,
    datedebut timestamp,
    datefin timestamp,
    idobjet int,
    foreign key ( idproprietaire )
        references utilisateur(idutilisateur),
    foreign key (idobjet)
        references objet( idObjet ) 
);


