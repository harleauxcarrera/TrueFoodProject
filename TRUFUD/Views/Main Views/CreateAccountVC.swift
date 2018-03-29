//
//  CreateAccountVC.swift
//  TRUFUD
//
//  Created by Erick Javier Duarte on 1/28/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//
import Alamofire
import UIKit

class CreateAccountVC: UIViewController {
    let URL_USER_REGISTER = "http://172.20.16.163/True_Food_App/ViewControllers/Register.php";
    var error_state: Int!
    @IBOutlet weak var email_field: UITextField!
    @IBOutlet weak var pwrd_field: UITextField!
    @IBAction func created_accnt(_ sender: Any) {
        
        if pwrd_field.text! == "" || email_field.text! == ""
            || pwrd_field.text! == " " || email_field.text! == " " {
            error_state = 3
            self.performSegue(withIdentifier: "AccntVerify", sender: self)
        }else{
            createAccount()
        }//end else
    }
    
    @IBAction func cancel(_ sender: Any) {
        self.performSegue(withIdentifier: "GeneralLogin", sender: self)
    }
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        var message: String!
        if segue.identifier == "AccntVerify"{
            if let nextVC: AccountCheckerVC =  segue.destination as? AccountCheckerVC{
                
                switch error_state {
                    
                case 1:
                    message = "Account already exists!"
                case 2:
                    message = "Server unavailable!"
                case 3:
                    message = "Please fill all fields!"
                default:
                    message = ""
                }
                nextVC.error_messg = message
                
            }
        }
    }
    
    func createAccount() {
        //creating parameters for the post request
        let parameters: Parameters=[
            "password":pwrd_field.text!,
            "email":email_field.text!
        ]
        
        //Sending http post request
        Alamofire.request(URL_USER_REGISTER, method: .post, parameters: parameters).responseJSON
            {
                response in
                //printing response
                //print(response)
                
                //getting the json value from the server
                if let result = response.result.value {
                    
                    let jsonData = result as! NSDictionary
                    let result = jsonData.value(forKey: "message") as! String?
                    if result == "User created successfully" {
                        //SEGUE TO APPLICATION
                        self.performSegue(withIdentifier: "Menu", sender: self)
                    }else if result == "User already exist" {
                        //NOTIFY ACCOUNT EXISTS
                        self.error_state = 1;
                        self.performSegue(withIdentifier: "AccntVerify", sender: self)
                    }else if result == "Some error occurred" {
                        //NOTIFY APP IS DOWN
                        self.error_state = 2;
                        self.performSegue(withIdentifier: "AccntVerify", sender: self)
                    }
                    //print(result)//debugging
                }
        }
        
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
}
