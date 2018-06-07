//
//  SecondViewController.swift
//  TRUFUD
//
//  Created by Carlos Herrera on 1/17/18.
//  Edited by Erick Duarte on 2/24/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//
import Alamofire
import UIKit

class EmailLogin: UIViewController {
    var error_state = 0
    let URL_USER_REGISTER = "http://192.168.0.7/True_Food_App/ViewControllers/Login.php";
    @IBOutlet weak var email_input: UITextField!
    @IBOutlet weak var psswrd_input: UITextField!

    @IBAction func login(_ sender: Any) {
        
        if psswrd_input.text! == "" || email_input.text! == ""
            || psswrd_input.text! == " " || email_input.text! == " " {
            error_state = 1
            self.performSegue(withIdentifier: "AccntVerify", sender: self)
        }else{
            createAccount()
        }//end else
        
    }
    
    @IBAction func cancel(_ sender: Any) {
        //back to startup page
        self.performSegue(withIdentifier: "GeneralLogin", sender: self)
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        var message = "No Account Found!";
        if segue.identifier == "AccntVerify"{
            if let nextVC: AccountCheckerVC =  segue.destination as? AccountCheckerVC{
                if error_state != 0 {
                    message = "Please fill in all fields!";
                }
                nextVC.error_messg = message
            }
        }
    }
    
    func createAccount(){
        //creating parameters for the post request
        let parameters: Parameters=[
            "password":psswrd_input.text!,
            "email":email_input.text!
        ]
        //Sending http post request
        Alamofire.request(URL_USER_REGISTER, method: .post, parameters: parameters).responseJSON
            {
                response in
                //printing response, for debugging
                print(response)
                
                //getting the json value from the server
                if let result = response.result.value {
                    let jsonData = result as! NSDictionary
                    //moving to appropriate segue if account exists
                    let result = jsonData.value(forKey: "message") as! String?
                    if result == "User exists" {
                        self.performSegue(withIdentifier: "Menu", sender: self)
                    }else if result == "User does not exist" {
                        self.performSegue(withIdentifier: "AccntVerify", sender: self)
                    }
                }
            }
        
    }
    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }

}

