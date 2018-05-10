//
//  RecipesVC.swift
//  TRUFUD
//
//  Created by Erick Javier Duarte on 5/10/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//

import UIKit
import SwiftyJSON

class RecipesVC: UIViewController {

    var recipes = [Recipe]()
    
    override func viewDidLoad() {
        super.viewDidLoad()
        fetchRecipes()
        // Do any additional setup after loading the view.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    func fetchRecipes(){
        //get request
        let url = URL(string: "http://192.168.100.11/True_Food_App/ViewControllers/Recipes.php")
        let session = URLSession.shared
        if let usableUrl = url {
            
            let task = session.dataTask(with: usableUrl, completionHandler: { (data, response, error) in
                
                if data == nil {
                    print("failed to retrieve ")
                }
                
                do{
                    
                    let jsonData = try JSONSerialization.jsonObject(with: data!, options: JSONSerialization.ReadingOptions.mutableContainers) as AnyObject
                    
                    //entire array of data fetched in JSON
                    
                    let json = JSON(jsonData)
                    
                    //now make objects of course with this data
                    
                    for course in json.arrayValue {
       
                        let recipeTitle = course["title"].stringValue
                        
                        let recipeLink = course["link"].stringValue
                        
                        let recipeIngridients = course["ingredients"].stringValue
                        
                        //create the course to add to array
                        let recipe = Recipe(title: recipeTitle, link: recipeLink, ingredients: recipeIngridients)
                        recipe.displayRecipes()
                        self.recipes.append(recipe)
                    }
       
                }catch{
                    print("Task not initiated")
                }
                
            })//end of session setup
            
            task.resume()
        }
    }//end function fetch classes
    
    
}
