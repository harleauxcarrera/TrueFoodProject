//
//  FirstViewController.swift
//  TRUFUD
//
//  Created by Carlos Herrera on 1/17/18.
//  Edited by Erick Javier Duarte on 2/24/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//

import UIKit
import GoogleSignIn

class GeneralLoginVC: UIViewController, GIDSignInUIDelegate {
    
    var dict : [String : AnyObject]!
    var google_signedin = false;
    
    override func viewDidLoad() {
        super.viewDidLoad()
        GIDSignIn.sharedInstance().uiDelegate = self
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    //MARK: GOOGLE SIGN IN AND CONFIGURATIONS
    @IBAction func google_signOn(_ sender: Any) {
        GIDSignIn.sharedInstance().signIn()
    }
    
    //for google sign
    func sign(_ signIn: GIDSignIn!, didSignInFor user: GIDGoogleUser!, withError error: Error!) {
        // Initialize sign-in
//        if let error = error {
//            print("\(error.localizedDescription)")
//        } else {
//            // Perform any operations on signed in user here.
//            let userId = user.userID                  // For client-side use only!
//            let idToken = user.authentication.idToken // Safe to send to the server
//            let fullName = user.profile.name
//            //let givenName = user.profile.givenName
//            //let familyName = user.profile.familyName
//            let email = user.profile.email
//            print("Google user Id: \(userId as String?), Token: \(idToken as String?), Name: \(fullName as String?), email: \(email as String?), ")
//            //permisson to go through app
//        }
        if let error = error {
            print(error.localizedDescription)
            return
        }else{
            google_signedin = true;
            self.performSegue(withIdentifier: "Menu", sender: self)
        }
        let authentication = user.authentication
        print("Access token:", authentication?.accessToken! ?? "No token attained")
    }
    
    // Perform any operations when the user disconnects from app here.
    func sign(_ signIn: GIDSignIn!, didDisconnectWith user: GIDGoogleUser!,
              withError error: Error!) {
    }
    
    //google sign in delegate
    func sign(inWillDispatch signIn: GIDSignIn!, error: Error!) {
    }
    
    // Present a view that prompts the user to sign in with Google
    func sign(_ signIn: GIDSignIn!,
              present viewController: UIViewController!) {
        self.present(viewController, animated: true, completion: nil)
    }
    
    // Dismiss the "Sign in with Google" view
    func sign(_ signIn: GIDSignIn!,
              dismiss viewController: UIViewController!) {
        self.dismiss(animated: true, completion: nil)
    }
    //MARK: FACEBOOK SIGN IN AND CONFIGURATIONS
    @IBAction func facebook_SignOn(_ sender: Any) {
        //transition to app when authenticated throught facebook
       //self.performSegue(withIdentifier: "Menu", sender: self)
    }
   
}//End general login

