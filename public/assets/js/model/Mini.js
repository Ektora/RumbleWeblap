
export const secondaryAllowed = {
  alliance: ["none", "cenarion", "undead"],
  horde: ["none", "blackrock"],
  undead: ["none", "beast", "horde"]
};

export class Mini{
    id;
    name;
    cost;
    type;
    mainFamily;
    secondFamily;
    description;
    leaderDescription;
    leaderFunnyDescription;
    constructor(){
        this.id = 0;
        this.name = "";
        this.cost = 1;
        this.mainFamily = "alliance";
        this.secondFamily = "none";
        this.description = "";
        this.leaderAbilityName = "";
        this.leaderAbilityDescription = "";
        this.leaderFunnyDescription = "";
    }

    getName(){
        return this.name;
    }

    setName(name){
        this.name = name;
    }

    getImageName(){

        let result = this.name.replaceAll(" ","-");
        result = this.name.replaceAll("\'","");
        return result.toLowerCase();
    }

    getCost(){
        return this.cost;
    }

    setCost(cost){
        if(cost>=0 || cost <10)
            this.cost = cost;
    }

    getMainFamily(){
        return this.mainFamily;
    }

    setMainFamily(mainFamily){
        if(this.secondFamily!= "none"){
            const allowed = new Set(secondaryAllowed[mainFamily]);
            if(allowed.has(this.secondFamily)){
                this.mainFamily = mainFamily;
            }
            else{
                this.mainFamily = mainFamily;
                this.secondFamily = "none";
            }
        }
        else{
            this.mainFamily = mainFamily;
        }
        console.log(this.name + " " + this.mainFamily + " " + this.secondFamily);
    }

    getSecondFamily(){
        return this.mainFamily;
    }

    setSecondFamily(secondFamily){
        if(secondFamily!= "none"){
            const allowed = new Set(secondaryAllowed[this.mainFamily]);
            if(allowed.has(secondFamily)){
                this.secondFamily = secondFamily;
            }
            else{
                this.secondFamily = "none";
            }
        }
        else{
            this.secondFamilyFamily = secondFamily;
        }
        console.log(this.name + " " + this.mainFamily + " " + this.secondFamily);
    }

}