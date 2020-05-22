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
public class Rate {
    private int id ;

    public Rate(int rating) {
        this.rating = rating;
    }

    public Rate(int id, int rating) {
        this.id = id;
        this.rating = rating;
    }
    private int rating ;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getRating() {
        return rating;
    }

    public void setRating(int rating) {
        this.rating = rating;
    }
    
    
}
