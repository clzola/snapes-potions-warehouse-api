<?php

namespace App\Support\Faker;

class PotionsProvider
{
    private $ingredientNames = [];

    private $ingredientPictures = [];


    public function __construct()
    {
        $this->ingredientNames = collect([
            "Abraxan hair", "Aconite", "Acromantula venom", "Adder's Fork", "African Red Pepper", "African Sea Salt",
            "Agrippa", "Alcohol", "Alihotsy", "Angel's Trumpet", "Anjelica", "Antimony", "Armadillo bile", "Armotentia",
            "Arnica", "Asian Dragon Hair", "Ashwinder egg", "Asphodel", "Balm", "Banana", "Baneberry", "Bat spleen",
            "Bat wing", "Beetle Eye", "Belladonna", "Betony", "Bezoar", "Horn of Bicorn", "Billywig sting",
            "Billywig sting slime", "Bitter root", "Blatta Pulvereus", "Blind-worm's Sting", "Blood", "Bloodroot",
            "Blowfly", "Bone", "Boom Berry", "Boomslang", "Boomslang skin", "Borage", "Bouncing Bulb",
            "Bouncing Spider Juice", "Bubotuber pus", "Bulbadox juice", "Bundimun Secretion", "Bursting mushroom",
            "Butterscotch", "Camphirated Spirit", "Castor oil", "Cat hair", "Caterpillar", "Centaury", "Cheese",
            "Chicken Lips", "Chinese Chomping Cabbage", "Chizpurfle carapace", "Chizpurfle fang", "Cinnamon", "Cockroach",
            "Cowbane", "Crocodile heart", "Daisy", "Dandelion root", "Dandruff", "Deadlyius", "Death-Cap", "Dittany",
            "Doxy egg", "Doxy venom", "Dragon blood", "Dragon claw", "Dragon Claw Ooze", "Dragon dung", "Dragon horn",
            "Dragon liver", "Dragonfly thorax", "Eagle owl feather", "Eel eye", "Erumpent horn", "Erumpent tail",
            "Essence of comfrey", "Essence of Daisyroot", "Exploding Fluid", "Exploding Ginger Eyelash", "Eye of Newt",
            "Eyeball", "Fairy wings", "Fanged Geranium", "Fillet of a Fenny Snake", "Fire", "Firefly", "Fire Seed",
            "Flabberghasted leech", "Flesh", "Flitterby", "Flobberworm Mucus", "Flower head", "Fluxweed", "Flying Seahorse",
            "Foxglove", "Frog", "Frog brain", "Galanthus Nivalis", "Giant Purple Toad wart", "Ginger", "Gomas Barbadensis",
            "Goosegrass", "Granian hair", "Graphorn horn", "Gravy", "Griffin claw", "Gillyweed", "Gnat Heads", "Gulf",
            "Gurdyroot", "Haliwinkles", "Hellebore", "Hemlock", "Herbaria", "Hermit crab shell", "Honey", "Honeywater",
            "Horklump juice", "Horned slug", "Horned toad", "Horse hair", "Horseradish", "Howlet's Wing", "Iguana blood",
            "Infusion of Wormwood", "Jewelweed", "Jobberknoll feather", "Kelp", "Knotgrass", "Lacewing fly",
            "Lady's Mantle", "Lavender", "Leech", "Leech juice", "Left handed nazle powder", "Lethe River Water",
            "Lionfish", "Spine of Lionfish", "Liver", "Lizard's Leg", "Lobalug venom", "Lovage", "Mackled Malaclaw tail",
            "Mallowsweet", "Mandrake", "Stewed Mandrake", "Mandrake Root", "Maw", "Mercury and Mars", "Mistletoe berry",
            "Mint", "Moly", "Moondew", "Moonseed", "Moonstone", "Morning dew", "Motherwort", "Murtlap tentacle", "Mushroom",
            "Nagini's venom", "Neem oil", "Nettle", "Newt", "Newt spleen", "Niffler's Fancy", "Nightshade", "Nux Myristica",
            "Occamy egg", "Octopus Powder", "Onion juice", "Peacock feather", "Pearl Dust", "Peppermint", "Petroleum Jelly",
            "Pickled Slugs", "Plangentine", "Plantain", "Poison ivy", "Polypody", "Pomegranate juice", "Pond Slime",
            "Poppy head", "Powder of vipers-flesh", "Porcupine quill", "Pritcher's Porritch", "Ptolemy (potion ingredient)",
            "Puffer-fish", "Puffer-fish eyes", "Puffskein hair", "Pungous Onion", "Pus", "Rat spleen", "Rat tail",
            "Re'em blood", "Rose", "Rose Petal", "Rose thorn", "Rose oil", "Rotten egg", "Rue", "Runespoor egg",
            "Russian's Dragon Nails", "Sage", "Sal Ammoniac", "Salamander blood", "Salpeter", "Salt", "Saltpetre",
            "Salt water", "Sardine", "Scale of Dragon", "Scarab beetle", "Scurvy grass", "Shrake spine", "Shrivelfig",
            "Silver", "Silverweed", "Sloth brain", "Snake fang", "Snake skin", "Snakeweed", "Sneezewort",
            "Sopophorous bean", "Sopophorous plant", "Spider", "Spirit of Myrrh", "Spleenwart", "Squill", "Squill bulb",
            "St John's-wort", "Staghorn", "Standard Ingredient", "Star Grass", "Starthistle", "Streeler shells",
            "Sulphur Vive", "Syrup of Arnica", "Syrup of Hellebore", "Tar", "Thaumatagoria", "Thyme",
            "Tincture of Demiguise", "Toe of Frog", "Tongue of Dog", "Tooth of Wolf", "en:Tormentil", "Tubeworm", "Turtle",
            "Unicorn blood", "Unicorn hair", "Unicorn horn", "Urine", "Valerian", "Valerian root", "Venomous Tentacula",
            "Venomous Tentacula leaf", "Vervain", "Vervain infusion", "Vinegar", "Wartcap powder", "Wartizome", "Water",
            "White spirit", "Wine", "Wiggenbush", "Wiggenbush bark", "Wiggentree", "Wiggentree bark", "Witch's Ganglion",
            "Witches' Mummy", "Woodlice Extract 63", "Wood louse", "Wool of Bat", "Wormwood", "Wormwood Essence"
        ]);

        $this->ingredientPictures = collect(scandir(storage_path('app/seeds/ingredients/pictures')))->filter(function ($item) {
            return $item !== '.' && $item !== '..';
        });
    }

    public function ingredientName()
    {
        return $this->ingredientNames->random();
    }

    public function ingredientPicture()
    {
        return $this->ingredientPictures->random();
    }
}
