
export class Mini{

    constructor({id,name,cost,type,"main-family":mainFamily,"second-family":secondFamily}){
        this.id = id;
        this.name = name;
        this.cost = cost;
        this.type = type;
        this.mainFamily = mainFamily;
        this.secondFamily = secondFamily;
    }

    toString(){
        return `${this.name}`;
    }


    familyNameToFamilyIcon(){
    let familyIcon = "";
    if(this.mainFamily == "" || this.mainFamily == null){
        familyIcon = "none";
    }
    familyIcon +=  this.mainFamily;

    if(this.secondFamily != "none"){
        familyIcon += this.secondFamily;
    }
    console.log(familyIcon);
    return familyIcon;
}
}