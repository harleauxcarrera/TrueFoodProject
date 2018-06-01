//
//  RecipesVC.swift
//  TRUFUD
//
//  Created by Erick Javier Duarte on 5/10/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//

import UIKit
import SwiftyJSON

class RecipesVC: UIViewController, UITableViewDelegate, UITableViewDataSource {
    
    @IBOutlet weak var tableView: UITableView!
    //let recipes = ["milk", "honey", "bread"]
    
    var recipes = [Recipe]()

    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return recipes.count
    }
    
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        return 200
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        
        let cell = tableView.dequeueReusableCell(withIdentifier: "RecipeCell") as! RecipesTableViewCell
        cell.Title.text = recipes[indexPath.row].title
        cell.link.text = recipes[indexPath.row].link
        cell.Ingredients.text = recipes[indexPath.row].ingredients
        
        return cell
    }
    

    
    override func viewDidLoad() {
        super.viewDidLoad()
        tableView.delegate = self
        tableView.dataSource = self
    }

    override func viewWillAppear(_ animated: Bool) {
        fetchRecipes()
    }
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    func fetchRecipes(){
        //get request
        let url = URL(string: "http://192.168.0.14/True_Food_App/ViewControllers/Recipes.php")
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
                    
                    for recipe in json.arrayValue {
       
                        let recipeTitle = recipe["title"].stringValue
                        
                        let recipeLink = recipe["link"].stringValue
                        
                        let recipeIngridients = recipe["ingredients"].stringValue
                        
                        //create the course to add to array
                        let fetchedRecipe = Recipe(title: recipeTitle, link: recipeLink, ingredients: recipeIngridients)
                        self.recipes.append(fetchedRecipe)
                    }
                    
                }catch{
                    print("Task not initiated")
                }
                
            })//end of session setup
            
            task.resume()
        }
    }//end function fetch classes
    
    func displayRecipes(){
        for rec in recipes{
            rec.displayRecipes()
        }
    }
    
}
