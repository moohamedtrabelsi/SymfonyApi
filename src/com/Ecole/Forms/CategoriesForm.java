/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.Ecole.Forms;

import com.Ecole.Models.Categorie;

import com.Ecole.Services.CategorieServices;
import com.codename1.components.ImageViewer;
import com.codename1.components.ScaleImageLabel;
import com.codename1.ui.Button;
import com.codename1.ui.Container;
import com.codename1.ui.Form;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.LayeredLayout;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import java.util.ArrayList;

/**
 *
 * @author Hamma
 */
public class CategoriesForm extends Form {
    
         private Resources theme1; 
 
    Resources res = UIManager.initFirstTheme("/theme");
        CategorieServices cs = new CategorieServices();
    public CategoriesForm() {
        super("Categories list", BoxLayout.y());
        
        
        Image img = res.getImage("f.jpg");
        ScaleImageLabel sl = new ScaleImageLabel(img);
        sl.setUIID("BottomPad");
        sl.setBackgroundType(Style.BACKGROUND_IMAGE_SCALED_FILL);
        
        
        Container aff =new Container(BoxLayout.y());
        
         for(Categorie c : cs.getAllCats()){
             Container cat =new Container(BoxLayout.y());
             Container carte = new Container(BoxLayout.x());
             
            Button afficher = new Button("afficher");
                     afficher.addActionListener((evt) -> {
                         LivresForm.c =c;
                                
            new LivresForm().show();
        });
             
             Label nom = new Label(c.getNom());
             nom.getAllStyles().setFgColor(000000);
             Label des = new Label(c.getDescription());
             Integer i = c.getRate();
             Label rat = new Label(i.toString());
             Button books = new Button();
             cat.addAll(nom,des,rat);
             ImageViewer ii = new ImageViewer(res.getImage("b.jpg").scaled(300, 300));
            
              carte.addAll(ii,cat,afficher);
              aff.add(carte);
             
             
         }
         this.setBgImage(img);
         add(LayeredLayout.encloseIn(
                aff
              
        ));
    
}}
