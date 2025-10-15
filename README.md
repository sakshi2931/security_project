# Detection and Prevention of Network Attacks using Snort and Iptables

## Project Overview
This project focuses on enhancing **network security** by detecting and preventing malicious network activities using **Snort (Intrusion Detection/Prevention System)** and **iptables (Linux firewall)**.  
It helps system administrators and security professionals to monitor real-time traffic, detect intrusions, and block malicious packets before they affect the network.

The main goal is to implement a simple yet effective **Intrusion Detection and Prevention System (IDPS)** that works efficiently on Linux-based environments.

---

## Objectives
- To detect and prevent common network-based attacks (e.g., ARP poisoning, port scanning, ICMP flooding).  
- To configure Snort for intrusion detection and alert generation.  
- To integrate Snort alerts with iptables for automated blocking of malicious IPs.  
- To analyze and visualize the captured data for security improvement.

---

## Tools and Technologies Used
| Tool/Technology | Purpose |

| **Snort** | Open-source Intrusion Detection and Prevention System |
| **iptables** | Packet filtering and firewall management tool |
| **Wireshark** | Packet capturing and traffic analysis |
| **Debian / Ubuntu** | Operating system environment |
| **TCPDump** | Command-line packet analyzer |
| **Syslog / Log files** | For analyzing alerts and attack patterns |

---

## Implementation Steps

### 1. Environment Setup
      - Installed **Debian Linux** in a virtual environment using VMware or VirtualBox.  
      - Updated system packages and installed required network analysis tools.
      
      ```bash
      sudo apt update && sudo apt upgrade -y

    2. **Configuring Snort**
      - Edited /etc/snort/snort.conf to include network variables and rules path.
        
      - Created custom Snort rules for detecting:
        
      - Port scanning
        
      - ICMP flooding
        
      - ARP spoofing
        
      - Suspicious TCP/UDP traffic

Example custom rule:

    '''bash
    alert icmp any any -> $HOME_NET any (msg:"ICMP Ping Detected"; sid:1000001; rev:1;)

    3. Testing Intrusion Detection

      - Used tools like hping3 and nmap to simulate attacks.
        
      - Verified Snort alerts in real-time using:
 
  Example:
  
    '''bash
    sudo snort -A console -q -c /etc/snort/snort.conf -i eth0

    4. Implementing Attack Prevention
  
      - Created iptables rules to block or drop suspicious traffic detected by Snort.
      
 Example:
      
      sudo iptables -A INPUT -s 192.168.1.100 -j DROP


Automated blocking by linking Snort alerts to iptables actions using scripts.


    5. Monitoring and Analysis
      - Observed Snort alert logs at /var/log/snort/alert.
      - Used Wireshark and TCPDump for deeper packet-level analysis.
      - Evaluated performance based on detection rate and response time.

## Results and Outcomes
     - Successfully detected and prevented simulated attacks (port scans, ICMP floods, ARP poisoning).
     - Improved network visibility and response time against intrusions.
     - Generated detailed logs for analysis and auditing.
     - Enhanced understanding of intrusion detection systems and firewall integration.

## How to Run This Project

# Step 1: Update system
sudo apt update

# Step 2: Install Snort and iptables
sudo apt install snort iptables -y

# Step 3: Configure Snort
sudo nano /etc/snort/snort.conf

# Step 4: Add custom Snort rules
sudo nano /etc/snort/rules/local.rules

# Step 5: Start Snort in IDS mode
sudo snort -A console -q -c /etc/snort/snort.conf -i eth0

# Step 6: Add iptables rules to block malicious IPs
sudo iptables -A INPUT -s <attacker_ip> -j DROP
