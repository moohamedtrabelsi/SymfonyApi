/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.Ecole.Services;

import com.Ecole.Models.Livre;
import com.Ecole.Utils.Api;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.events.ActionListener;

/**
 *
 * @author Hamma
 */
public class LivreServices {
    
    public static LivreServices instance = null ;
    public boolean resultOK;
    private ConnectionRequest req;

    public LivreServices() {
        req = new ConnectionRequest();
    }
    
     public static LivreServices getInstance() {
        if (instance == null) {
            instance = new LivreServices();
        }
        return instance;
    }
    
    
    
    public void reserver(Livre l)
    {
        String url=Api.url+l.getId()+"/1/reserver";
        req.setUrl(url);
             req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
    
    }
    
    
}
