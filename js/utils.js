function odobriOglas(id) {
    let odgovor=confirm("Odobravanje oglasa: Da li ste sigurni?");
    if (odgovor)
    window.location = "odobri_oglas.php?id="+id;
    return false;
}

function obrisiOglas(id) {
    let odgovor=confirm("Brisanje oglasa: Da li ste sigurni?");
    if (odgovor)
    window.location = "obrisi_oglas.php?id="+id;
    return false;
}