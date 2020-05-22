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
public class Categorie {
    private int id ;
    private String description;
    private int rate ;
    private String nom;

    public Categorie() {
    }

    public Categorie(String description, int rate, String nom) {
        this.description = description;
        this.rate = rate;
        this.nom = nom;
    }

    public Categorie(String description, String nom) {
        this.description = description;
        this.nom = nom;
        this.rate=0;
    }

    public Categorie(int id, String description, int rate, String nom) {
        this.id = id;
        this.description = description;
        this.rate = rate;
        this.nom = nom;
    }

    @Override
    public String toString() {
        return "Categorie{" + "id=" + id + ", description=" + description + ", rate=" + rate + ", nom=" + nom + '}';
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getRate() {
        return rate;
    }

    public void setRate(int rate) {
        this.rate = rate;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }
    
}
