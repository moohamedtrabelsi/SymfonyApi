/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.Ecole.Models;

/**
 *
 * @author Mohamed Trabelsi
 */

public class Livre {
    private int id ;
    private Categorie c;
    private String titre ;
    private String etat;

    public Livre(Categorie c, String titre) {
        this.c = c;
        this.titre = titre;
        this.etat="disponible";
        this.rating=0;
        this.nbj=0;
        this.nbv=0;
    }
    public Livre()
    {
        
    }
    private int rating;
    private int nbv;
    private int nbj;    

    public Livre(Categorie c, String titre, String etat, int rating, int nbv, int nbj) {
        this.c = c;
        this.titre = titre;
        this.etat = etat;
        this.rating = rating;
        this.nbv = nbv;
        this.nbj = nbj;
    }

    public Livre(int id, String titre, String etat, int rating, int nbv, int nbj) {
        this.id = id;
        this.titre = titre;
        this.etat = etat;
        this.rating = rating;
        this.nbv = nbv;
        this.nbj = nbj;
    }

    public Livre(int id, Categorie c, String titre, String etat, int rating, int nbv, int nbj) {
        this.id = id;
        this.c = c;
        this.titre = titre;
        this.etat = etat;
        this.rating = rating;
        this.nbv = nbv;
        this.nbj = nbj;
    }

    public Categorie getC() {
        return c;
    }

    public void setC(Categorie c) {
        this.c = c;
    }

    public String getTitre() {
        return titre;
    }

    public void setTitre(String titre) {
        this.titre = titre;
    }

    @Override
    public String toString() {
        return "Livre{" + "id=" + id + ", c=" + c + ", titre=" + titre + ", etat=" + etat + ", rating=" + rating + ", nbv=" + nbv + ", nbj=" + nbj + '}';
    }

    public String getEtat() {
        return etat;
    }

    public void setEtat(String etat) {
        this.etat = etat;
    }

    public int getRating() {
        return rating;
    }

    public void setRating(int rating) {
        this.rating = rating;
    }

    public int getNbv() {
        return nbv;
    }

    public void setNbv(int nbv) {
        this.nbv = nbv;
    }

    public int getNbj() {
        return nbj;
    }

    public void setNbj(int nbj) {
        this.nbj = nbj;
    }

    public Livre(int id) {
        this.id = id;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
}
