//
//  RecipesTableViewCell.swift
//  TRUFUD
//
//  Created by Erick Javier Duarte on 5/31/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//

import UIKit

class RecipesTableViewCell: UITableViewCell {
    @IBOutlet weak var Title: UILabel!
    
    @IBOutlet weak var link: UILabel!
    
    @IBOutlet weak var Ingredients: UILabel!
    
    
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
