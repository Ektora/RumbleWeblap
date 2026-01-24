
export class Mini{

    constructor({id,name,cost,type,"main-family":mainFamily,"second-family":secondFamily}){
        this.id = id;
        this.name = name ?? "Kobold";
        this.cost = cost;
        this.type = type ?? "troop";
        this.mainFamily = mainFamily ?? "neutral";
        this.secondFamily = secondFamily ?? "none";
    }

    toString(){
        return `${this.name}`;
    }


    mergeFamilyNames(){
    let familyName = "";
    familyName +=  this.mainFamily;

    if(this.secondFamily != "none"){
        familyName += this.secondFamily;
    }
    return familyName;
}

    getImageName(){
        let imageName = this.name.replaceAll(" ","-").toLowerCase();
        return imageName;
    }

    familyNameToStatueName(){
    let statueBaseImageName;
    let mainFamilyHelper;
    let secondFamilyHelper;
    if(this.mainFamily == "neutral"){
        statueBaseImageName = "Statue_Base_Neutral_Pose";
    }
    else if(this.secondFamily == "none"){
        mainFamilyHelper = this.mainFamily.slice(0,1).toUpperCase() + this.mainFamily.slice(1,this.mainFamily.length)
        statueBaseImageName = `Statue_Base_${mainFamilyHelper}_Pose`;
    }
    else{
        mainFamilyHelper = this.mainFamily.slice(0,1).toUpperCase() + this.mainFamily.slice(1,this.mainFamily.length);
        secondFamilyHelper = this.secondFamily.slice(0,1).toUpperCase() + this.secondFamily.slice(1,this.secondFamily.length)
        statueBaseImageName = `Statue_Base_Split_${mainFamilyHelper}_${secondFamilyHelper}_Pose`;
    }
    return statueBaseImageName;
}

familyNameToGradient(){
    let gradient = "";
    gradient +=  this.mainFamily;

    if(this.secondFamily != "none"){
        gradient = gradient + "-" + this.secondFamily;
    }
    return gradient;
}
}