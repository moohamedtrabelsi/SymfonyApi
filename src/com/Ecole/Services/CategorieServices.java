/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.Ecole.Services;
import com.Ecole.Models.Categorie;
import com.Ecole.Models.Livre;
import com.Ecole.Utils.Api;
import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.events.ActionListener;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;
/**
 *
 * @author Hamma
 */
public class CategorieServices {
    public ArrayList<Categorie> cats;
    public ArrayList<Livre> livres;
    
    public static CategorieServices instance=null;
    public boolean resultOK;
    private ConnectionRequest req;
    
    public CategorieServices() {
         req = new ConnectionRequest();
    }
    
     public static CategorieServices getInstance() {
        if (instance == null) {
            instance = new CategorieServices();
        }
        return instance;
    }
     
      public boolean addCat(Categorie t) {
        String url = Api.url + "newcat?description="+t.getDescription()+"&nom="+t.getNom()+"&rating="+t.getRate();
        req.setUrl(url);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;
    }
      
      public ArrayList<Categorie> parseCats(String jsonText){
        try {
            cats=new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> tasksListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
            List<Map<String,Object>> list = (List<Map<String,Object>>)tasksListJson.get("root");
            for(Map<String,Object> obj : list){
                Categorie t = new Categorie();
                float id = Float.parseFloat(obj.get("id").toString());
                t.setId((int)id);
                t.setDescription(obj.get("description").toString());
                t.setNom(obj.get("nom").toString());
                t.setRate(((int)Float.parseFloat(obj.get("rating").toString())));
                cats.add(t);
            }
            
            
        } catch (IOException ex) {
            
        }
        return cats;
    }
      
        public ArrayList<Categorie> getAllCats(){
        //String url = Api.url+"/allcat/";
        String url =Api.url+"allcat";
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                cats = parseCats(new String(req.getResponseData()));
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return cats;
    }
     
        
        
         public ArrayList<Livre> parsebooks(String jsonText){
        try {
            livres=new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> tasksListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
            List<Map<String,Object>> list = (List<Map<String,Object>>)tasksListJson.get("root");
            for(Map<String,Object> obj : list){
                Livre t = new Livre();
                float id = Float.parseFloat(obj.get("id").toString());
                t.setId((int)id);
                t.setEtat(obj.get("disponible").toString());
                t.setTitre(obj.get("titre").toString());
                t.setRating(((int)Float.parseFloat(obj.get("rating").toString())));
                t.setNbj(((int)Float.parseFloat(obj.get("nbj").toString())));
                t.setNbv(((int)Float.parseFloat(obj.get("nbv").toString())));
                livres.add(t);
            }
            
            
        } catch (IOException ex) {
            
        }
        return livres;
    }
        
        
        public ArrayList<Livre> getAllbooks(Categorie c){
        //String url = Api.url+"/allcat/";
        String url =Api.url+c.getId()+"/livres";
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                livres = parsebooks(new String(req.getResponseData()));
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return livres;
    } 
    
    
}
