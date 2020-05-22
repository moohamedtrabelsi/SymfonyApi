/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.Ecole.Models;

import java.util.Date;

/**
 *
 * @author Mohamed Trabelsi
 */
public class Reservation {
    private int id ;
    private Livre l;
    private User u;
    private Date df;
    private Date dd;

    public int getId() {
        return id;
    }

    @Override
    public String toString() {
        return "Reservation{" + "id=" + id + ", l=" + l + ", u=" + u + ", date fin :" + df + ", date debut :" + dd + '}';
    }

    public void setId(int id) {
        this.id = id;
    }

    public Livre getL() {
        return l;
    }

    public void setL(Livre l) {
        this.l = l;
    }

    public User getU() {
        return u;
    }

    public void setU(User u) {
        this.u = u;
    }

    public Date getDf() {
        return df;
    }

    public void setDf(Date df) {
        this.df = df;
    }

    public Date getDd() {
        return dd;
    }

    public void setDd(Date dd) {
        this.dd = dd;
    }

    public Reservation(Livre l, User u) {
        this.l = l;
        this.u = u;
    }

    public Reservation(int id, Livre l, User u) {
        this.id = id;
        this.l = l;
        this.u = u;
    }

  

    public Reservation() {
    }
    
}
