import React, { useContext, useEffect, useState } from "react";
import {
  View,
  Text,
  StyleSheet,
  ScrollView,
  TouchableOpacity,
  Image,
} from "react-native";
import Icon from "react-native-vector-icons/FontAwesome5";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { AuthContext } from "../AuthContext";

const MyImage = require("../../../../assets/favicon.png");

const Cart = ({ navigation }) => {
  const [userDetails, setUserDetails] = useState(null);
  const [scentData, setScentData] = useState([]);
  const { user } = useContext(AuthContext);

  useEffect(() => {
    getUserData();
    getDataFromDB();
    const unsubscribe = navigation.addListener("focus", getDataFromDB);
    return unsubscribe;
  }, [navigation]);

  const getUserData = async () => {
    const userData = await AsyncStorage.getItem("userData");
    if (userData) {
      setUserDetails(JSON.parse(userData));
    }
  };

  const getDataFromDB = async () => {
    const url = new URL("http://172.22.112.1/Library/api/cart/" + user.userID);
    const response = await fetch(url, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.json();
    setScentData(data.data);
  };

  const deleteData = async (id) => {
    const url = `http://172.22.112.1/Library/api/cart/${id}`;

    const response = await fetch(url, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (response.ok) {
      getDataFromDB();
    }
  };

  const PlantCard = ({ data }) => (
    <TouchableOpacity style={styles.card}>
      <View style={styles.imageContainer}>
        <Image source={MyImage} style={styles.productImage} />
      </View>
      <View style={styles.productInfo}>
        <Text style={styles.productName}>{data.name}</Text>
        <Text style={styles.productPrice}>Php {data.price}</Text>
        <TouchableOpacity onPress={() => deleteData(data.cart_id)}>
          <Icon name="trash" style={styles.iconTrash} />
        </TouchableOpacity>
      </View>
    </TouchableOpacity>
  );

  return (
    <View style={styles.container}>
      <ScrollView>
        <View style={styles.header}>
          <Icon
            name="arrow-left"
            style={styles.backIcon}
            onPress={() => navigation.goBack()}
          />
          <Icon
            name="sign-out-alt"
            style={styles.signOutIcon}
            onPress={() => navigation.navigate("LoginScreen")}
          />
        </View>
        <View style={styles.subContainer}>
          <Text style={styles.titleText}>
            Welcome to Library{" "}
            {userDetails?.fullname || userDetails?.displayName}
          </Text>
          <Text style={styles.subHead}>
            Discover the best scents with Library - where every scent tells a story.
          </Text>
        </View>
        <View style={styles.productContainer}>
          {scentData.map((data) => (
            <PlantCard data={data} key={data.cart_id} />
          ))}
        </View>
      </ScrollView>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#f0f0f5", // Light background
  },
  header: {
    flexDirection: "row",
    justifyContent: "space-between",
    alignItems: "center",
    paddingHorizontal: 20,
    paddingVertical: 15,
    backgroundColor: "#6a1b9a", // Purple header
  },
  backIcon: {
    fontSize: 24,
    color: "#FFFFFF",
  },
  signOutIcon: {
    fontSize: 24,
    color: "#FFFFFF",
  },
  subContainer: {
    padding: 20,
    backgroundColor: "#ffffff",
    borderBottomLeftRadius: 20,
    borderBottomRightRadius: 20,
    marginBottom: 20,
    shadowColor: "#000",
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.1,
    shadowRadius: 4,
    elevation: 3,
  },
  productContainer: {
    flexDirection: "column",
    alignItems: "center",
  },
  card: {
    width: "90%",
    marginVertical: 10,
    backgroundColor: "#fff",
    borderRadius: 10,
    overflow: "hidden",
    shadowColor: "#000",
    shadowOpacity: 0.1,
    shadowOffset: { width: 0, height: 2 },
    shadowRadius: 8,
    elevation: 2,
  },
  imageContainer: {
    width: "100%",
    height: 120,
    backgroundColor: "#e0e0e0",
    justifyContent: "center",
    alignItems: "center",
  },
  productImage: {
    width: "80%",
    height: "80%",
    resizeMode: "contain",
  },
  productInfo: {
    padding: 16,
    flexDirection: "row",
    justifyContent: "space-between",
    alignItems: "center",
  },
  productName: {
    fontSize: 18,
    color: "#333",
    fontWeight: "600",
  },
  productPrice: {
    fontSize: 16,
    color: "#6a1b9a",
  },
  titleText: {
    fontSize: 24,
    color: "#6a1b9a",
    fontWeight: "bold",
    textAlign: "center",
    marginBottom: 10,
  },
  subHead: {
    fontSize: 16,
    color: "#777",
    textAlign: "center",
    marginBottom: 20,
  },
  iconTrash: {
    fontSize: 20,
    color: "#E53935",
  },
});

export default Cart;
