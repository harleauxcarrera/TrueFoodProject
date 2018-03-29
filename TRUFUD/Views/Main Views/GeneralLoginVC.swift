//
//  FirstViewController.swift
//  TRUFUD
//
//  Created by Carlos Herrera on 1/17/18.
//  Edited by Erick Javier Duarte on 2/24/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//

import UIKit
import FacebookLogin
import FBSDKLoginKit

class GeneralLoginVC: UIViewController{
    
    var dict : [String : AnyObject]!
    
    @IBAction func google_signOn(_ sender: Any) {
        
      
    }
    

    @IBAction func facebook_SignOn(_ sender: Any) {
        //if the user is already logged in
        if let accessToken = FBSDKAccessToken.current(){
            getFBUserData()
            //redirect now to App
            self.performSegue(withIdentifier: "Menu", sender: self)
            
        }else{
        
            let loginManager = LoginManager()
            loginManager.logIn(readPermissions: [.publicProfile], viewController: self, completion: { loginResult in
                switch loginResult {
                case .failed(let error):
                    print(error)
                case .cancelled:
                    print("User cancelled login.")
                case .success(let grantedPermissions, let declinedPermissions, let accessToken):
                    print("Logged in!")
                    //redirect now to App
                    self.performSegue(withIdentifier: "Menu", sender: self)
                    
                }
            })
            
        }
        
        
    }
    
    //function is fetching the user data
    func getFBUserData(){
        if((FBSDKAccessToken.current()) != nil){
            FBSDKGraphRequest(graphPath: "me", parameters: ["fields": "id, name, picture.type(large), email"]).start(completionHandler: { (connection, result, error) -> Void in
                if (error == nil){
                    self.dict = result as! [String : AnyObject]
                    print(result!)
                    print(self.dict)
                }
            })
        }
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

   
}

