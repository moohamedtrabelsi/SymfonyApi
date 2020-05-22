/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.Ecole.Forms;

import com.Ecole.Models.Categorie;
import com.Ecole.Models.Livre;
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

/**
 *
 * @author Hamma
 */
public class LivresForm extends Form{
     Resources res = UIManager.initFirstTheme("/theme");
        CategorieServices cs = new CategorieServices();
    public static Categorie c;

    public LivresForm() {
      super("Books list", BoxLayout.y());
      
       Image img = res.getImage("f.jpg");
        ScaleImageLabel sl = new ScaleImageLabel(img);
        sl.setUIID("BottomPad");
        sl.setBackgroundType(Style.BACKGROUND_IMAGE_SCALED_FILL);
        
        Container aff =new Container(BoxLayout.y());
        
                 for(Livre l : cs.getAllbooks(c)){
             Container cat =new Container(BoxLayout.y());
             Container carte = new Container(BoxLayout.x());
             
            Button afficher = new Button("reserver");
                     afficher.addActionListener((evt) -> {
            new LivresForm().show();
        });
             
             Label titre = new Label(l.getTitre());
             titre.getAllStyles().setFgColor(000000);
            // Label des = new Label(c.getDescription());
             Integer i = l.getRating();
             Label rat = new Label(i.toString());
             Button books = new Button();
             cat.addAll(titre,rat);
             ImageViewer ii = new ImageViewer(res.getImage("b.jpg").scaled(300, 300));
            
              carte.addAll(ii,cat,afficher);
              aff.add(carte);
         }
      
           this.setBgImage(img);
         add(LayeredLayout.encloseIn(
                aff
              
        ));
        
        
        
    }
    
   
        
        
    
}
