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
public class User {
    private int id ;
    private String login ;
    private String role;
    private String password;
    private String nom;
    private String prenom;

    public String getLogin() {
        return login;
    }

    public User(String login, String password) {
        this.login = login;
        this.password = password;
    }

    public User() {
    }

    public void setLogin(String login) {
        this.login = login;
    }

    @Override
    public String toString() {
        return "User{" + "id=" + id + ", login=" + login + ", role=" + role + ", password=" + password + ", nom=" + nom + ", prenom=" + prenom + '}';
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public User(int id, String login, String role, String password, String nom, String prenom) {
        this.id = id;
        this.login = login;
        this.role = role;
        this.password = password;
        this.nom = nom;
        this.prenom = prenom;
    }
    

    public User(int id) {
        this.id = id;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
    
}
