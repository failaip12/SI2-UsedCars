-- PostgreSQL Schema

CREATE SCHEMA IF NOT EXISTS cars;

-- -----------------------------------------------------
-- Table cars.nalozi
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cars.nalozi (
    nalog_id SERIAL PRIMARY KEY,
    tip INTEGER NOT NULL
);

-- -----------------------------------------------------
-- Table cars.admin
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cars.admin (
    admin_id SERIAL PRIMARY KEY,
    email VARCHAR(80) NOT NULL,
    password VARCHAR(80) NOT NULL,
    ime VARCHAR(45),
    prezime VARCHAR(45),
    nalog_id INTEGER NOT NULL,
    CONSTRAINT fk_admin_nalozi
        FOREIGN KEY (nalog_id)
        REFERENCES cars.nalozi (nalog_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
);

CREATE INDEX idx_admin_nalog_id ON cars.admin(nalog_id);

-- -----------------------------------------------------
-- Table cars.korisnik
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cars.korisnik (
    korisnik_id SERIAL PRIMARY KEY,
    email VARCHAR(80) NOT NULL,
    password VARCHAR(80) NOT NULL,
    ime VARCHAR(45),
    prezime VARCHAR(45),
    mobilni VARCHAR(45),
    grad VARCHAR(45),
    datum_rodjenja VARCHAR(45),
    nalog_id INTEGER NOT NULL,
    CONSTRAINT fk_korisnik_nalozi
        FOREIGN KEY (nalog_id)
        REFERENCES cars.nalozi (nalog_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
);

CREATE INDEX idx_korisnik_nalog_id ON cars.korisnik(nalog_id);

-- -----------------------------------------------------
-- Table cars.oglasi
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cars.oglasi (
    oglas_id SERIAL PRIMARY KEY,
    naslov VARCHAR(80) NOT NULL,
    marka VARCHAR(45) NOT NULL,
    model VARCHAR(45) NOT NULL,
    godiste INTEGER NOT NULL,
    kilometraza INTEGER NOT NULL,
    cena INTEGER NOT NULL,
    pogon VARCHAR(45) NOT NULL,
    menjac VARCHAR(45) NOT NULL,
    gorivo VARCHAR(45) NOT NULL,
    kubikaza INTEGER NOT NULL,
    snaga INTEGER NOT NULL,
    broj_vrata VARCHAR(45) NOT NULL,
    broj_sedista INTEGER NOT NULL,
    opis_oglasa VARCHAR(1000) NOT NULL,
    korisnik_id INTEGER NOT NULL,
    admin_id INTEGER,
    CONSTRAINT fk_oglas_korisnik
        FOREIGN KEY (korisnik_id)
        REFERENCES cars.korisnik (korisnik_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT fk_oglas_admin
        FOREIGN KEY (admin_id)
        REFERENCES cars.admin (admin_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
);

CREATE INDEX idx_oglas_korisnik_id ON cars.oglasi(korisnik_id);
CREATE INDEX idx_oglas_admin_id ON cars.oglasi(admin_id);

-- -----------------------------------------------------
-- Table cars.slika
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cars.slika (
    slika_id SERIAL PRIMARY KEY,
    hash VARCHAR(80) NOT NULL UNIQUE
);

-- -----------------------------------------------------
-- Table cars.oglas_ima_sliku
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cars.oglas_ima_sliku (
    oglas_id INTEGER NOT NULL,
    slika_id INTEGER NOT NULL,
    PRIMARY KEY (oglas_id, slika_id),
    CONSTRAINT fk_oglas_ima_sliku_oglasi
        FOREIGN KEY (oglas_id)
        REFERENCES cars.oglasi (oglas_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT fk_oglas_ima_sliku_slika
        FOREIGN KEY (slika_id)
        REFERENCES cars.slika (slika_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
);

CREATE INDEX idx_oglas_ima_sliku_slika_id ON cars.oglas_ima_sliku(slika_id);

-- -----------------------------------------------------
-- Table cars.pretraga
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cars.pretraga (
    pretraga_id SERIAL PRIMARY KEY,
    marka VARCHAR(45),
    model VARCHAR(45),
    godiste_od VARCHAR(45),
    godiste_do VARCHAR(45),
    kilometraza_od VARCHAR(45),
    kilometraza_do VARCHAR(45),
    cena_od VARCHAR(45),
    cena_do VARCHAR(45),
    pogon VARCHAR(45),
    menjac VARCHAR(45),
    gorivo VARCHAR(45),
    kubikaza_od VARCHAR(45),
    kubikaza_do VARCHAR(45),
    snaga_od VARCHAR(45),
    snaga_do VARCHAR(45),
    korisnik_id INTEGER NOT NULL,
    CONSTRAINT fk_pretraga_korisnik
        FOREIGN KEY (korisnik_id)
        REFERENCES cars.korisnik (korisnik_id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
);

CREATE INDEX idx_pretraga_korisnik_id ON cars.pretraga(korisnik_id);

-- -----------------------------------------------------
-- Initial Data
-- -----------------------------------------------------
INSERT INTO cars.nalozi (nalog_id, tip) VALUES (1, 2);
INSERT INTO cars.admin (email, password, nalog_id) 
VALUES ('admin@1.1', '$2y$10$17hZo8MY8Bh6gNeU4WmV1uILiRLJceY1eepkomnh9xeG6REj2A8ti', 1); 